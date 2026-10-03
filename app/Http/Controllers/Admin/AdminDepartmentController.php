<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminDepartmentController extends Controller
{
    public function index()
    {
        return view('admin.departments.index', ['departments' => Department::ordered()->paginate(20)]);
    }

    public function create()
    {
        return view('admin.departments.form', ['department' => new Department]);
    }

    public function store(Request $request)
    {
        Department::create($this->data($request));

        return redirect()->route('admin.departments.index')->with('success', 'Department added.');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.form', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $data = $this->data($request);
        \Illuminate\Support\Facades\DB::transaction(function () use ($department, $data) {
            $oldName = $department->name;
            $department->update($data);
            if ($oldName !== $department->name) {
                \App\Models\Doctor::where('department', $oldName)->update(['department' => $department->name]);
            }
        });

        return redirect()->route('admin.departments.index')->with('success', 'Department updated.');
    }

    public function destroy(Department $department)
    {
        if (\App\Models\Doctor::where('department', $department->name)->exists()) {
            return back()->withErrors(['department' => 'Reassign the doctors in this department before removing it.']);
        }
        $department->delete();

        return back()->with('success', 'Department removed.');
    }

    private function data(Request $request): array
    {
        $data = $request->validate(['name' => 'required|string|max:255', 'icon' => 'nullable|string|max:100', 'description' => 'nullable|string|max:2000', 'sort_order' => 'nullable|integer|min:0']);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] ??= 0;

        return $data;
    }
}
