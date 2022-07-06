<?php

namespace App\View\Components\LandingPage;

use App\Models\GalleryCategory;
use Illuminate\View\Component;

class Gallery extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = [
            'categories' => GalleryCategory::active()->get(),
        ];
        return view('components.landing-page.gallery', $data);
    }
}
