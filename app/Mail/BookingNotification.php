<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;        // Booking model instance
    public $recipientType;  // 'therapist' or 'patient'
    public $meetingLink;    // Meeting link

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Booking  $booking
     * @param  string  $recipientType
     */
    public function __construct($booking, $recipientType)
    {
        $this->booking = $booking;
        $this->recipientType = $recipientType;
        $this->meetingLink = $booking->meeting_link ?? null; // Add meeting link
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->recipientType === 'therapist'
            ? 'New Booking Received'
            : 'Booking Confirmation';

        return $this->subject($subject)
                    ->view('emails.booking-notification')
                    ->with([
                        'booking' => $this->booking,
                        'recipientType' => $this->recipientType,
                        'meetingLink' => $this->meetingLink, // Pass meeting link
                    ]);
    }
}
