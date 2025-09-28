@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold text-primary">Admin Control Panel</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- ✅ Employer Verification --}}
    <div class="card shadow mb-5">
        <div class="card-header bg-info text-white fw-semibold">Unverified Employers</div>
        <div class="card-body">
            @if($employers->isEmpty())
                <p class="text-muted text-center">No unverified employers found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employers as $emp)
                                <tr>
                                    <td>{{ $emp->UserID }}</td>
                                    <td>{{ $emp->Name }}</td>
                                    <td>{{ $emp->Email }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.update.employer', $emp->UserID) }}">
                                            @csrf
                                            <input type="hidden" name="VerifiedStatus" value="1">
                                            <button type="submit" class="btn btn-sm btn-success">✔ Verify</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- ✅ Application Status --}}
    <div class="card shadow">
        <div class="card-header bg-warning text-dark fw-semibold">Pending Job Applications</div>
        <div class="card-body">
            @if($applications->isEmpty())
                <p class="text-muted text-center">No pending applications found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Application ID</th>
                                <th>Job ID</th>
                                <th>Seeker ID</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $app)
                                <tr>
                                    <td>{{ $app->ApplicationID }}</td>
                                    <td>{{ $app->JobID }}</td>
                                    <td>{{ $app->SeekerID }}</td>
                                    <td>{{ $app->AppliedDate }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.update.application', $app->ApplicationID) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Reviewed">
                                            <button type="submit" class="btn btn-sm btn-success">✔ Mark Reviewed</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.update.application', $app->ApplicationID) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Rejected">
                                            <button type="submit" class="btn btn-sm btn-danger">✖ Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
