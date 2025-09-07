<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\VideoOffer;
use App\Events\VideoAnswer;
use App\Events\VideoCandidate;

class VedioController extends Controller
{
    /**
     * Send WebRTC offer to other peer
     */
    public function sendOffer(Request $request)
    {
        broadcast(new VideoOffer($request->offer))->toOthers();
        return response()->json(['status' => 'Offer sent']);
    }

    /**
     * Send WebRTC answer to other peer
     */
    public function sendAnswer(Request $request)
    {
        broadcast(new VideoAnswer($request->answer))->toOthers();
        return response()->json(['status' => 'Answer sent']);
    }

    /**
     * Send ICE candidate to other peer
     */
    public function sendCandidate(Request $request)
    {
        broadcast(new VideoCandidate($request->candidate))->toOthers();
        return response()->json(['status' => 'Candidate sent']);
    }
}
