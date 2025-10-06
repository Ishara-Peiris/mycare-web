<!DOCTYPE html>
<html>
<head>
    <title>Booking Notification</title>
</head>
<body>
    <h2>Hello {{ $recipientType === 'therapist' ? $booking->therapist->user->name : $booking->user->name }}</h2>

    @if($recipientType === 'therapist')
        <p>You have a new session booked by {{ $booking->user->name }}.</p>
    @else
        <p>Your booking with {{ $booking->therapist->user->name }} is confirmed.</p>
    @endif

    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->session_date)->format('M d, Y') }}</p>
    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->session_time)->format('h:i A') }}</p>

    @if(isset($meetingLink))
        <p><strong>Join your session here:</strong></p>
        <p><a href="{{ $meetingLink }}" target="_blank">{{ $meetingLink }}</a></p>
    @endif

    <p>Thank you!</p>
</body>
</html>
