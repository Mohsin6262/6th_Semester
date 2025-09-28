@extends('layout')

@php use Illuminate\Support\Str; @endphp

@section('styles')
<style>
  .hero {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset("images/job-hero.jpg") }}') center/cover no-repeat;
    height: 320px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .hero h1 {
    font-size: 3rem;
    font-weight: bold;
  }

  .search-box {
    margin-top: -40px;
    z-index: 10;
    position: relative;
  }

  .job-card {
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: all 0.2s ease-in-out;
  }

  .job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
  }

  .btn-apply {
    border-radius: 20px;
    font-weight: 500;
  }

  .offcanvas {
    width: 400px;
  }

  @media (max-width: 768px) {
    .offcanvas {
      width: 100%;
    }
  }
</style>
@endsection

@section('content')

<div class="hero">
  <div class="container">
    <h1>Find Your Next Opportunity</h1>
    <p class="lead">Search thousands of jobs from top companies</p>
  </div>
</div>

<div class="container search-box">
  <form action="{{ route('jobs.index') }}" method="GET" class="input-group shadow rounded overflow-hidden mb-5">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-lg" placeholder="Job title, keywords, or company">
    <button class="btn btn-primary btn-lg">Search</button>
  </form>
</div>

<div class="container">
  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif

  @if($jobs->isEmpty())
    <p class="text-center text-muted">No jobs found. Try a different search term.</p>
  @else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @foreach($jobs as $job)
        <div class="col">
          <div class="card job-card p-3 h-100">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $job->Title }}</h5>
              <p class="text-muted mb-2">{{ $job->Location }}</p>
              <p class="card-text text-muted flex-grow-1">{{ Str::limit($job->Description ?? '', 140) }}</p>

              <button class="btn btn-sm btn-link mt-2" data-bs-toggle="offcanvas" data-bs-target="#details{{ $job->JobID }}">
                Show Details
              </button>

              <a href="{{ route('jobs.apply', $job->JobID) }}" class="btn btn-outline-primary btn-apply mt-2">Apply Now</a>
            </div>
          </div>
        </div>

        <!-- Offcanvas Detail Panel -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="details{{ $job->JobID }}" aria-labelledby="detailsLabel{{ $job->JobID }}">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="detailsLabel{{ $job->JobID }}">{{ $job->Title }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <p><strong>Location:</strong> {{ $job->Location }}</p>
            <p><strong>Salary:</strong> {{ $job->SalaryRange ?? 'Not specified' }}</p>
            <hr>
            <p><strong>Description:</strong></p>
            <p>{{ $job->Description ?? 'No description provided.' }}</p>
            <p><strong>Requirements:</strong></p>
            <p>{{ $job->Requirements ?? 'No requirements provided.' }}</p>
            <a href="{{ route('jobs.apply', $job->JobID) }}" class="btn btn-primary mt-3">Apply Now</a>
          </div>
        </div>
      @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
      {{ $jobs->withQueryString()->links() }}
    </div>
  @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@endsection
