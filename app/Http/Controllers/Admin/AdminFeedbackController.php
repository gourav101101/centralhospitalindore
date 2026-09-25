<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientFeedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientFeedback::latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('patient_name', 'like', "%{$s}%")
                  ->orWhere('department', 'like', "%{$s}%")
                  ->orWhere('feedback', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        $feedbacks = $query->paginate(15);
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function updateStatus(Request $request, PatientFeedback $feedback)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $feedback->update(['status' => $request->status]);
        return back()->with('success', 'Feedback status updated.');
    }

    public function destroy(PatientFeedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedback.index')->with('success', 'Feedback deleted.');
    }
}
