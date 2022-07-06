<?php
namespace App\View\Components\LandingPage;

use App\Models\ServiceLanding;
use Illuminate\View\Component;

class LayananKami extends Component
{
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        $data = [
            'services' => ServiceLanding::all(),
        ];
        return view('components.landing-page.layanan-kami', $data);
    }
}
