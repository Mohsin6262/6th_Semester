@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <!-- Left Side: Illustration -->
        <div class="col-md-6 mb-4">
           <img src="{{ asset('images/submit_application.png') }}" class="img-fluid" alt="Job Application" style="max-height: 400px;">
        </div>

        <!-- Right Side: Form -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4 text-primary">Apply for <strong>{{ $job->Title }}</strong></h2>
                    <form action="{{ route('jobs.apply.submit', $job->JobID) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Upload Resume <small class="text-muted">(PDF, DOC, DOCX)</small></label>
                            <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cover Letter</label>
                            <textarea name="cover_letter" class="form-control" rows="5" placeholder="Write a short message..." required></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-success btn-lg">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('jobs.index') }}" class="text-decoration-none text-secondary">← Back to Job Listings</a>
            </div>
        </div>
    </div>
</div>
@endsection
