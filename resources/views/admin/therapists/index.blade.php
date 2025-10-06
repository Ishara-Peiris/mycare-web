<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapists List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome for Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4">🧑‍⚕️ Therapists List (Admin Panel)</h1>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Specialization</th>
                <th>Status</th>
                <th>OCR Check</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($therapists as $therapist)
                <tr>
                    <td>{{ $therapist->id }}</td>
                    {{-- Access the related User model using $therapist->user --}}
                    <td>
                        <strong>{{ $therapist->user->name ?? 'N/A' }}</strong><br>
                        <small class="text-muted">{{ $therapist->user->email ?? 'N/A' }}</small>
                    </td>
                    
                    <td>{{ $therapist->specialization }} ({{ $therapist->experience_years }} Yrs)</td>
                    
                    <td>
                        {{-- Display overall verification status --}}
                        @if($therapist->is_verified)
                            <span class="badge bg-success py-2">✅ APPROVED</span>
                        @else
                            <span class="badge bg-warning text-dark py-2">⏳ PENDING</span>
                        @endif
                    </td>

                    <td>
                        {{-- Display the result of the Automated OCR Check --}}
                        @if($therapist->is_verified)
                            <span class="text-secondary small">Verification complete.</span>
                        @elseif($therapist->is_keyword_found)
                            <span class="badge bg-info text-dark">Keywords Found</span>
                            <i class="fas fa-search-plus text-info ms-1"></i>
                        @else
                            <span class="badge bg-danger">File Check Failed</span>
                            <i class="fas fa-exclamation-triangle text-danger ms-1"></i>
                        @endif
                    </td>

                    <td class="text-nowrap">
                        {{-- View Details Link (Crucial for reviewing certificate) --}}
                        <a href="{{ route('admin.therapists.show', $therapist) }}" class="btn btn-info btn-sm me-2">
                            <i class="fas fa-eye"></i> Review
                        </a>

                        {{-- Action Forms (Approve/Reject) --}}
                        @if(!$therapist->is_verified)
                            {{-- Approve Form --}}
                            <form action="{{ route('admin.therapists.approve', $therapist) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" 
                                    onclick="return confirm('Are you sure you want to approve this therapist? You must have reviewed their qualifications.')">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                        @else
                            {{-- Reject Form (Only visible if already verified) --}}
                            <form action="{{ route('admin.therapists.reject', $therapist) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to reject/unverify this therapist?')">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <div class="alert alert-info mb-0">No therapists found in the database.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>