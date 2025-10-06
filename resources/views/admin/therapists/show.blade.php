<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist Details: {{ $therapist->user->name ?? 'N/A' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body style="background-color: #f3e5f5;"> {{-- Light purple background for the body --}}

<div class="container py-5">
    
    {{-- Session Flash Message for Actions --}}
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        
        {{-- Card Header with Purplish Background --}}
        <div class="card-header text-white" style="background-color: #6a1b9a; border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <h2 class="mb-0">
                <i class="fas fa-user-md me-2"></i> Therapist Profile: {{ $therapist->user->name ?? 'N/A' }}
            </h2>
        </div>

        <div class="card-body p-4">
            <div class="row">
                
                {{-- Left Column: Image and Status --}}
                <div class="col-md-4 text-center border-end">
                    
                    {{-- Profile Image --}}
                    @if($therapist->image)
                        <img src="{{ asset('storage/' . $therapist->image) }}" alt="Profile Image" 
                             class="img-fluid rounded-circle mb-3 shadow" 
                             style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #ab47bc;">
                    @else
                        {{-- Placeholder if no image --}}
                        <div class="d-inline-block p-4 mb-3 rounded-circle text-white shadow" style="background-color: #ab47bc; width: 150px; height: 150px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user fa-5x"></i>
                        </div>
                    @endif

                    <h4 class="mt-2">{{ $therapist->user->name ?? 'N/A' }}</h4>
                    <p class="mb-3">
                        @if($therapist->is_verified)
                            <span class="badge bg-success py-2 px-3"><i class="fas fa-check-circle"></i> VERIFIED</span>
                        @else
                            <span class="badge bg-warning text-dark py-2 px-3"><i class="fas fa-hourglass-half"></i> PENDING</span>
                        @endif
                    </p>

                    {{-- Verification/Rejection Actions --}}
                    <div class="d-grid gap-2">
                        @if(!$therapist->is_verified)
                            {{-- Approve Form --}}
                            <form action="{{ route('admin.therapists.approve', $therapist) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100"><i class="fas fa-thumbs-up me-1"></i> Approve Therapist</button>
                            </form>
                        @else
                            {{-- Reject Form --}}
                            <form action="{{ route('admin.therapists.reject', $therapist) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm w-100"><i class="fas fa-times-circle me-1"></i> Reject/Unverify</button>
                            </form>
                        @endif
                        <a href="{{ route('admin.therapists') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2"><i class="fas fa-arrow-left me-1"></i> Back to List</a>
                    </div>
                </div>

                {{-- Right Column: Details and Documents --}}
                <div class="col-md-8">
                    <h4 class="border-bottom pb-2 mb-3" style="color: #6a1b9a;">Professional Information</h4>
                    
                    <dl class="row mb-4">
                        <dt class="col-sm-4 text-muted">Specialization:</dt>
                        <dd class="col-sm-8 fw-bold">{{ $therapist->specialization }}</dd>

                        <dt class="col-sm-4 text-muted">Experience:</dt>
                        <dd class="col-sm-8">{{ $therapist->experience_years }} years</dd>

                        <dt class="col-sm-4 text-muted">Consultation Fee:</dt>
                        <dd class="col-sm-8 text-success fw-bold">${{ number_format($therapist->consultation_fee, 2) }}</dd>

                        <dt class="col-sm-4 text-muted">Languages:</dt>
                        <dd class="col-sm-8">{{ $therapist->languages }}</dd>

                        <dt class="col-sm-4 text-muted">Email:</dt>
                        <dd class="col-sm-8"><a href="mailto:{{ $therapist->user->email ?? '' }}">{{ $therapist->user->email ?? 'N/A' }}</a></dd>
                    </dl>

                    <h4 class="border-bottom pb-2 mb-3" style="color: #6a1b9a;">About the Therapist</h4>
                    <p class="text-justify bg-light p-3 rounded">{{ $therapist->description ?? 'No detailed description provided.' }}</p>

                    <h4 class="border-bottom pb-2 mb-3 mt-4" style="color: #6a1b9a;">Verification Documents</h4>
                    @php
                        // Safely decode the JSON 'documents' field if it exists
                        $documents = is_string($therapist->documents) ? json_decode($therapist->documents, true) : $therapist->documents;
                    @endphp

                    @if(!empty($documents) && is_array($documents)) 
                        <ul class="list-group list-group-flush">
                            @foreach($documents as $doc)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <i class="far fa-file-alt me-2 text-primary"></i> {{ basename($doc) }}
                                    <a href="{{ asset('storage/' . $doc) }}" target="_blank" class="btn btn-sm text-white" style="background-color: #ab47bc;">
                                        <i class="fas fa-eye me-1"></i> View Document
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info">No documents uploaded for verification.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>