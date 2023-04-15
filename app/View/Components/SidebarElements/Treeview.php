<?php

namespace App\View\Components\SidebarElements;

use Illuminate\View\Component;

class Treeview extends Component
{
    public $faIcon;
    public $text;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($faIcon, $text)
    {
        $this->faIcon = $faIcon;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-elements.treeview');
    }
}
