@extends('layout')

@section('content')
<div class="container mt-5">
  <h2 class="mb-4">My Profile</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('profile.update') }}">
    @csrf

    <!-- Common Fields -->
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" value="{{ old('name', $user->Name) }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->Email) }}" class="form-control" required>
    </div>

    <!-- Jobseeker Profile Fields -->
    @if($user->UserType === 'jobseeker')
      <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->DateOfBirth ?? '') }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" name="address" value="{{ old('address', $profile->Address ?? '') }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Profile Summary</label>
        <textarea name="profile_summary" class="form-control" rows="4" required>{{ old('profile_summary', $profile->ProfileSummary ?? '') }}</textarea>
      </div>

    <!-- Employer Profile Fields -->
    @else
     <!-- Company Name Field -->
<div class="mb-3">
  <label class="form-label">Company Name</label>
  <input type="text" name="CompanyName" value="{{ old('CompanyName', $profile->CompanyName) }}" class="form-control" required>
</div>


      <div class="mb-3">
        <label class="form-label">Company Description</label>
        <textarea name="company_description" class="form-control" rows="4" required>{{ old('company_description', $profile->CompanyDescription ?? '') }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Company Website</label>
        <input type="url" name="company_website" class="form-control"
               value="{{ old('company_website', $profile->CompanyWebsite ?? '') }}">
      </div>

      <!-- Verified Status Display -->
      <div class="mb-3">
        <label class="form-label">Verified Status</label><br>
        @if(isset($profile->VerifiedStatus) && $profile->VerifiedStatus)
          <span class="badge bg-success">Verified</span>
        @else
          <span class="badge bg-warning text-dark">Not Verified</span>
        @endif
      </div>
    @endif

    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>
</div>
@endsection
