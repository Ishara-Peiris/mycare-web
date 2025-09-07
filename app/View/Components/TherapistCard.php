<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Therapist;

class TherapistCard extends Component
{
    public $therapist;

    /**
     * Create a new component instance.
     */
    public function __construct(Therapist $therapist)
    {
        $this->therapist = $therapist;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.therapist-card');
    }
}
