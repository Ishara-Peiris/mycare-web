<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VideoCandidate implements ShouldBroadcast
{
    use InteractsWithSockets;

    public $candidate;

    public function __construct($candidate)
    {
        $this->candidate = $candidate;
    }

    public function broadcastOn()
    {
        return ['video-channel'];
    }

    public function broadcastAs()
    {
        return 'VideoCandidate';
    }
}
