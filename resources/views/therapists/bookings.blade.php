<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Confirmed Bookings</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS for sorting/searching -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 30px;
            font-weight: 600;
        }
        .badge-status {
            font-size: 0.9rem;
            padding: 0.4em 0.7em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">My Confirmed Bookings</h2>

        @if($bookings->isEmpty())
            <div class="alert alert-info text-center mt-4">
                No confirmed bookings found.
            </div>
        @else
            <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered" id="bookingsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Patient Email</th>
                            <th>Session Date</th>
                            <th>Session Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->patient->name }}</td>
                                <td>{{ $booking->patient->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->session_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->session_time)->format('h:i A') }}</td>
                                <td>
                                    <span class="badge bg-success badge-status">{{ ucfirst($booking->status) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bookingsTable').DataTable({
                "ordering": true,
                "paging": true,
                "searching": true,
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });
        });
    </script>
</body>
</html>
