<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VideoAnswer implements ShouldBroadcast
{
    use InteractsWithSockets;

    public $answer;

    public function __construct($answer)
    {
        $this->answer = $answer;
    }

    public function broadcastOn()
    {
        return ['video-channel'];
    }

    public function broadcastAs()
    {
        return 'VideoAnswer';
    }
}
