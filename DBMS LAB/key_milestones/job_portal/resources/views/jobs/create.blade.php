@extends('layout')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Post a New Job</h2>

  {{-- Display validation errors --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Job post form --}}
  <form method="POST" action="{{ route('jobs.store') }}">
    @csrf
    <div class="mb-3">
      <label for="company_name" class="form-label">Company Name</label>
      <input type="text" name="company_name" class="form-control" required>
    </div>
    
    <div class="mb-3">
      <label for="title" class="form-label">Job Title</label>
      <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Job Description</label>
      <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
      <label for="requirements" class="form-label">Requirements</label>
      <textarea name="requirements" class="form-control" rows="4" required>{{ old('requirements') }}</textarea>
    </div>

    <div class="mb-3">
      <label for="location" class="form-label">Location</label>
      <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
    </div>

    <div class="mb-3">
      <label for="salary" class="form-label">Salary Range</label>
      <input type="text" name="salary" class="form-control" value="{{ old('salary') }}" required>
    </div>

   

    <button type="submit" class="btn btn-success w-100">Post Job</button>
  </form>
</div>



@endsection
