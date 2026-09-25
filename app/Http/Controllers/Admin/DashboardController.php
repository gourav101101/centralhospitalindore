<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard with stats.
     */
    public function index()
    {
        $stats = [
            'today_appointments' => Appointment::today()->count(),
            'pending_appointments' => Appointment::pending()->count(),
            'unread_messages' => ContactMessage::unread()->count(),
            'active_doctors' => Doctor::active()->count(),
            'active_departments' => Department::active()->count(),
            'published_blogs' => Blog::published()->count(),
            'active_testimonials' => Testimonial::active()->count(),
        ];

        $todayAppointments = Appointment::query()
            ->whereDate('preferred_date', today())
            ->orderBy('time_slot')
            ->take(6)
            ->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $departmentDemand = Appointment::query()
            ->select('department', DB::raw('count(*) as total'))
            ->whereNotNull('department')
            ->groupBy('department')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats', 'todayAppointments', 'recentMessages', 'departmentDemand'
        ));
    }
}
