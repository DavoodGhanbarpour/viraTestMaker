<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ProfileSection extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userFullName = Auth::user()->name;
        $this->userRole     = translatedRole( Auth::user()->role );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile-section', [ 'userFullName' => $this->userFullName, 'role' => $this->userRole ]);
    }
}
