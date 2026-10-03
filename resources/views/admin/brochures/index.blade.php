@extends('admin.layouts.app')
@section('page-title', 'Brochure downloads')
@section('content')
<div class="page-head"><div><h2>Brochure downloads</h2><p>Upload the hospital brochure for Resources &amp; Downloads. A new upload replaces the current brochure.</p></div><a class="button button-muted" href="{{ route('downloads') }}" target="_blank" rel="noopener">View downloads</a></div>
@if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
<form class="panel" method="post" enctype="multipart/form-data" action="{{ route('admin.brochures.store') }}">@csrf
<label for="brochure">PDF brochure (maximum 15 MB)</label><input id="brochure" name="brochure" type="file" accept="application/pdf" required><button class="button">Upload brochure</button></form>
@if($brochure)<div class="panel"><h3>{{ $brochure->original_name }}</h3><a class="button button-muted" href="{{ asset($brochure->file_path) }}" target="_blank" rel="noopener">Open PDF</a>
<form method="post" action="{{ route('admin.brochures.destroy', $brochure) }}" onsubmit="return confirm('Remove this brochure from the website?')">@csrf @method('DELETE')<button class="button">Remove brochure</button></form></div>
@else<div class="panel">No brochure uploaded yet.</div>@endif
@endsection
