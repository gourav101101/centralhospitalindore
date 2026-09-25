@extends('admin.layouts.app')

@php
  $meta = [
    'appointments' => ['Appointments', 'Review and update appointment requests.'],
    'enquiries' => ['Patient enquiries', 'Review messages received through the website.'],
    'directory' => ['Doctors & departments', 'Current directory data shown on the public website.'],
    'content' => ['Content & media', 'Published health-library and social-proof content.'],
  ][$section];
@endphp
@section('title', $meta[0] . ' | Central Hospital Indore Admin')
@section('page-title', $meta[0])
@section('breadcrumb', 'Central Hospital Indore Admin | ' . $meta[0])
@section('content')
  <div class="page-head"><div><h2>{{ $meta[0] }}</h2><p>{{ $meta[1] }}</p></div></div>
  @if(session('success'))<div class="notice">{{ session('success') }}</div>@endif

  @if($section === 'appointments')
    <form class="filters" method="get" action="{{ route('admin.appointments') }}"><input name="search" value="{{ request('search') }}" placeholder="Search patient, phone, department"><select name="status"><option value="">All statuses</option>@foreach(['pending','confirmed','completed','cancelled'] as $status)<option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>@endforeach</select><input type="date" name="date" value="{{ request('date') }}"><button class="button">Filter</button><a class="button button-muted" href="{{ route('admin.appointments') }}">Clear</a></form>
    <div class="panel table-wrap"><table class="table"><thead><tr><th>Patient</th><th>Appointment</th><th>Contact</th><th>Status</th><th></th></tr></thead><tbody>
    @forelse($records as $record)<tr><td><strong>{{ $record->patient_name }}</strong><small>{{ $record->age ? $record->age . ' years' : 'Age not provided' }}</small></td><td><strong>{{ $record->department }}</strong><small>{{ $record->preferred_date->format('d M Y') }} | {{ $record->time_slot }}</small></td><td>{{ $record->phone }}<small>{{ $record->email }}</small></td><td><span class="pill {{ $record->status === 'pending' ? 'warning' : ($record->status === 'cancelled' ? 'danger' : 'success') }}">{{ ucfirst($record->status) }}</span></td><td><a class="button button-muted" href="{{ route('admin.appointments.show', $record) }}">View</a></td></tr>@empty<tr><td colspan="5" class="empty">No appointment requests match the selected filters.</td></tr>@endforelse
    </tbody></table></div>{{ $records->links() }}
  @elseif($section === 'enquiries')
    <form class="filters" method="get" action="{{ route('admin.enquiries') }}"><input name="search" value="{{ request('search') }}" placeholder="Search name, email, phone, subject"><select name="status"><option value="">All workflow states</option>@foreach(['new' => 'New', 'in_progress' => 'In progress', 'resolved' => 'Resolved'] as $value => $label)<option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>@endforeach</select><button class="button">Filter</button><a class="button button-muted" href="{{ route('admin.enquiries') }}">Clear</a></form>
    <div class="panel table-wrap"><table class="table"><thead><tr><th>Sender</th><th>Subject & message</th><th>Received</th><th>Status</th><th></th></tr></thead><tbody>
    @forelse($records as $record)<tr><td><strong>{{ $record->name }}</strong><small>{{ $record->email }}{{ $record->phone ? ' | ' . $record->phone : '' }}</small></td><td><strong>{{ $record->subject }}</strong><small>{{ \Illuminate\Support\Str::limit($record->message, 90) }}</small></td><td>{{ $record->created_at->format('d M Y') }}<small>{{ $record->created_at->diffForHumans() }}</small></td><td><span class="pill {{ $record->status === 'new' ? 'warning' : ($record->status === 'resolved' ? 'success' : 'blue') }}">{{ $record->status === 'in_progress' ? 'In progress' : ucfirst($record->status) }}</span></td><td><a class="button button-muted" href="{{ route('admin.enquiries.show', $record) }}">View</a></td></tr>@empty<tr><td colspan="5" class="empty">No patient enquiries match the selected filters.</td></tr>@endforelse
    </tbody></table></div>{{ $records->links() }}
  @elseif($section === 'directory')
    <div class="split"><div class="panel"><h2>Doctors ({{ $doctors->count() }})</h2><ul class="summary-list">@forelse($doctors as $doctor)<li><strong>{{ $doctor->name }}</strong><small>{{ $doctor->designation }} | {{ $doctor->department }} | {{ $doctor->is_active ? 'Active' : 'Hidden' }}</small></li>@empty<li class="empty">No doctors have been added.</li>@endforelse</ul></div><div class="panel"><h2>Departments ({{ $departments->count() }})</h2><ul class="summary-list">@forelse($departments as $department)<li><strong>{{ $department->name }}</strong><small>{{ $department->is_active ? 'Active on website' : 'Hidden from website' }}</small></li>@empty<li class="empty">No departments have been added.</li>@endforelse</ul></div></div>
  @else
    <div class="split"><div class="panel"><h2>Health-library articles</h2><ul class="summary-list">@forelse($blogs as $blog)<li><strong>{{ $blog->title }}</strong><small>{{ $blog->is_published ? 'Published' : 'Draft' }} | {{ $blog->author }}</small></li>@empty<li class="empty">No articles yet.</li>@endforelse</ul></div><div class="panel"><h2>Testimonials</h2><ul class="summary-list">@forelse($testimonials as $testimonial)<li><strong>{{ $testimonial->client_name }}</strong><small>{{ $testimonial->rating }}/5 | {{ $testimonial->is_active ? 'Active' : 'Hidden' }}</small></li>@empty<li class="empty">No testimonials yet.</li>@endforelse</ul><h2 style="margin-top:20px">Current brochure</h2><p class="empty">{{ $brochure?->original_name ?? 'No brochure uploaded.' }}</p></div></div>
  @endif
@endsection
