<?php

namespace App\View\Components\SidebarElements;

use Illuminate\View\Component;

class Navlink extends Component
{
    public $link;
    public $text;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $text)
    {
        $this->link = $link;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-elements.navlink');
    }
}
