<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NavBar extends Component
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user(); // get logged in user, null if guest
    }

    public function render()
    {
        return view('components.nav-bar');
    }
}
