<?php

namespace App\Http\Controllers;

use App\Models\ServiceLanding;

class ServiceController extends Controller
{
    public function index($serviceLandingId)
    {
        $data = [
            'service' => ServiceLanding::where('service_landing_id', $serviceLandingId)->first(),
            'services' => ServiceLanding::where('service_landing_active', 'Y')->orderBy('created_at')->take(5)->get(),
        ];
        return view('landing-page.layanan-kami', $data);
    }
}
