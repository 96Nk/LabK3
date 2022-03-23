<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use function view;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $title = null,
        public ?string $loader = null,
        public ?string $style = null,
        public ?string $script = null
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('theme-admin.app');
    }
}
