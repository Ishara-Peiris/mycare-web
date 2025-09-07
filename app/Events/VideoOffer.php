<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VideoOffer implements ShouldBroadcast
{
    use InteractsWithSockets;

    public $offer;

    public function __construct($offer)
    {
        $this->offer = $offer;
    }

    public function broadcastOn()
    {
        return ['video-channel'];
    }

    public function broadcastAs()
    {
        return 'VideoOffer';
    }
}
