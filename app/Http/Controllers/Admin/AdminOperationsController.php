<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Brochure;
use App\Models\ContactMessage;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminOperationsController extends Controller
{
    public function appointments(Request $request)
    {
        $query = Appointment::query()->latest();

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();
            $query->where(function ($builder) use ($search) {
                $builder->where('patient_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('preferred_doctor', 'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        if ($request->filled('date')) {
            $query->whereDate('preferred_date', $request->date('date'));
        }

        return view('admin.operations', [
            'section' => 'appointments',
            'records' => $query->paginate(20)->withQueryString(),
        ]);
    }

    public function showAppointment(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function enquiries(Request $request)
    {
        $query = ContactMessage::query()->latest();
        if ($request->filled('search')) {
            $search = $request->string('search')->trim();
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return view('admin.operations', [
            'section' => 'enquiries',
            'records' => $query->paginate(20)->withQueryString(),
        ]);
    }

    public function showEnquiry(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);

        return view('admin.enquiries.show', compact('contactMessage'));
    }

    public function directory()
    {
        return view('admin.operations', [
            'section' => 'directory',
            'doctors' => Doctor::ordered()->get(),
            'departments' => Department::ordered()->get(),
        ]);
    }

    public function content()
    {
        return view('admin.operations', [
            'section' => 'content',
            'blogs' => Blog::latest()->take(12)->get(),
            'testimonials' => Testimonial::ordered()->take(12)->get(),
            'brochure' => Brochure::latest()->first(),
        ]);
    }

    public function updateAppointment(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'admin_notes' => 'nullable|string|max:2000',
        ]);
        $appointment->update($data);

        return back()->with('success', 'Appointment status updated.');
    }

    public function markEnquiryRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);

        return back()->with('success', 'Enquiry marked as read.');
    }

    public function updateEnquiry(Request $request, ContactMessage $contactMessage)
    {
        $data = $request->validate([
            'status' => 'required|in:new,in_progress,resolved',
            'admin_notes' => 'nullable|string|max:2000',
        ]);
        $data['is_read'] = true;
        $contactMessage->update($data);

        return back()->with('success', 'Enquiry updated.');
    }
}
