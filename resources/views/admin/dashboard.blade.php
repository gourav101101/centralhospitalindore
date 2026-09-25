@extends('admin.layouts.app')
@section('title', 'Dashboard — Central Hospital Indore Admin')
@section('page-title', 'Operations Dashboard')
@section('breadcrumb', '{{ now()->format("l, d F Y") }} · Appointments & enquiries')

@section('content')

@if(session('success'))
  <div class="notice">{{ session('success') }}</div>
@endif

{{-- Stat cards --}}
<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-label">Appointments today</div>
    <div class="stat-value">{{ $stats['today_appointments'] }}</div>
    <div class="stat-sub">Scheduled for today</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Awaiting confirmation</div>
    <div class="stat-value">{{ $stats['pending_appointments'] }}</div>
    <div class="stat-sub">Requires follow-up</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Unread enquiries</div>
    <div class="stat-value">{{ $stats['unread_messages'] }}</div>
    <div class="stat-sub">Website contact requests</div>
  </div>
</div>

{{-- Data panels --}}
<div class="panel-grid">
  <div class="panel" id="appointments">
    <h2>Today's appointment requests</h2>
    @forelse($todayAppointments as $appointment)
      <div class="data-row">
        <div>
          <strong>{{ $appointment->patient_name }}</strong>
          <span>{{ $appointment->department }} · {{ $appointment->time_slot }}</span>
        </div>
        <span class="pill blue">{{ ucfirst($appointment->status) }}</span>
      </div>
    @empty
      <div class="empty">No appointment requests scheduled for today.</div>
    @endforelse
  </div>

  <div class="panel" id="enquiries">
    <h2>Recent patient enquiries</h2>
    @forelse($recentMessages as $message)
      <div class="data-row">
        <div>
          <strong>{{ $message->name }}</strong>
          <span>{{ $message->subject }} · {{ $message->created_at->diffForHumans() }}</span>
        </div>
        <span class="pill {{ $message->is_read ? '' : 'warning' }}">{{ $message->is_read ? 'Read' : 'New' }}</span>
      </div>
    @empty
      <div class="empty">No contact enquiries yet.</div>
    @endforelse
  </div>

  <div class="panel">
    <h2>Most requested departments</h2>
    @forelse($departmentDemand as $department)
      <div class="data-row">
        <strong>{{ $department->department }}</strong>
        <span class="pill blue">{{ $department->total }} requests</span>
      </div>
    @empty
      <div class="empty">Data appears when appointment requests arrive.</div>
    @endforelse
  </div>

</div>

{{-- Info cards --}}
<div class="info-grid" id="content">
  <div class="info-card">
    <div class="ic-value">{{ $stats['active_doctors'] }}</div>
    <div class="ic-label">Active doctors</div>
    <div class="ic-sub">Keep profiles and availability current.</div>
  </div>
  <div class="info-card">
    <div class="ic-value">{{ $stats['active_departments'] }}</div>
    <div class="ic-label">Active departments</div>
    <div class="ic-sub">Maintain services and department information.</div>
  </div>
  <div class="info-card">
    <div class="ic-value">{{ $stats['published_blogs'] }}</div>
    <div class="ic-label">Published articles</div>
    <div class="ic-sub">Health-library content available to visitors.</div>
  </div>
</div>

@endsection
