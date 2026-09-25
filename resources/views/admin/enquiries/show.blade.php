@extends('admin.layouts.app')
@section('title', 'Patient enquiry | Central Hospital Indore Admin')
@section('page-title', 'Patient enquiry')
@section('breadcrumb', 'Central Hospital Indore Admin | Enquiries | #' . $contactMessage->id)
@section('content')
  <div class="page-head"><div><h2>{{ $contactMessage->name }}</h2><p>Received {{ $contactMessage->created_at->format('d M Y, h:i A') }}</p></div><a class="button button-muted" href="{{ route('admin.enquiries') }}">Back to enquiries</a></div>
  @if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
  <div class="detail-grid"><section class="panel"><h2>Contact details</h2><div class="detail-item"><label>Email</label><strong>{{ $contactMessage->email }}</strong></div><div class="detail-item"><label>Phone</label><strong>{{ $contactMessage->phone ?: 'Not provided' }}</strong></div></section><section class="panel"><h2>Enquiry</h2><div class="detail-item"><label>Subject</label><strong>{{ $contactMessage->subject }}</strong></div><div class="detail-item"><label>Message</label><strong>{{ $contactMessage->message }}</strong></div></section></div>
  <section class="panel" style="margin-top:14px"><h2>Follow-up</h2><form method="post" action="{{ route('admin.enquiries.update', $contactMessage) }}">@csrf @method('PATCH')<label for="status">Workflow status</label><select class="form-control" id="status" name="status">@foreach(['new' => 'New', 'in_progress' => 'In progress', 'resolved' => 'Resolved'] as $value => $label)<option value="{{ $value }}" @selected($contactMessage->status === $value)>{{ $label }}</option>@endforeach</select><label for="admin_notes" style="display:block;margin-top:14px">Internal handling notes</label><textarea class="form-control notes" id="admin_notes" name="admin_notes" placeholder="Add follow-up steps or a response summary.">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea><button class="button">Save enquiry update</button></form></section>
@endsection
