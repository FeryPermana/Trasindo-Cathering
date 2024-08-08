<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfileCard extends Component
{
    public $user;
    public $company;
    public $role;

    /**
     * Create a new component instance.
     *
     * @param  $user
     * @param  $company
     * @param  $role
     * @return void
     */
    public function __construct($user, $company = null, $role)
    {
        $this->user = $user;
        $this->company = $company;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.profile-card');
    }
}
