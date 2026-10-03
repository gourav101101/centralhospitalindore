@extends('admin.layouts.app')
@section('page-title', 'Patient feedback')
@section('content')
<div class="page-head"><div><h2>Patient feedback</h2><p>Review submissions from the website. Review status is internal; publish patient stories separately with permission.</p></div></div>
@if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
<form method="get" class="panel" style="display:flex;gap:12px;flex-wrap:wrap">
<input class="form-control" name="search" value="{{ request('search') }}" placeholder="Search feedback" aria-label="Search feedback">
<select name="status" class="form-control" aria-label="Status"><option value="">All statuses</option>@foreach(['pending','approved','rejected'] as $status)<option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>@endforeach</select>
<button class="button">Filter</button><a href="{{ route('admin.feedback.index') }}">Reset</a></form>
<div class="panel table-wrap"><table class="table"><thead><tr><th>Patient</th><th>Feedback</th><th>Review</th></tr></thead><tbody>
@forelse($feedbacks as $feedback)<tr><td><strong>{{ $feedback->patient_name }}</strong><small>{{ $feedback->department }} | {{ $feedback->rating }}/5</small></td><td style="white-space:pre-wrap">{{ $feedback->feedback }}</td><td>
<form method="post" action="{{ route('admin.feedback.update', $feedback) }}">@csrf @method('PATCH')
<select name="status" class="form-control" aria-label="Review status">@foreach(['pending','approved','rejected'] as $status)<option value="{{ $status }}" @selected($feedback->status === $status)>{{ ucfirst($status) }}</option>@endforeach</select><button class="button">Save</button></form>
<form method="post" action="{{ route('admin.feedback.destroy', $feedback) }}" onsubmit="return confirm('Delete this feedback?')">@csrf @method('DELETE')<button class="button button-muted">Delete</button></form>
</td></tr>@empty<tr><td colspan="3">No feedback found.</td></tr>@endforelse
</tbody></table></div>{{ $feedbacks->links() }}
@endsection
