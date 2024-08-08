<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuCard extends Component
{
    public $menu;
    public $role;

    /**
     * Create a new component instance.
     *
     * @param  $menu
     * @param  $role
     * @return void
     */
    public function __construct($menu, $role)
    {
        $this->menu = $menu;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu-card');
    }
}
