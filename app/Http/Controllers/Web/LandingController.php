<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SiteContent;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $services = Service::with('caseImages')->orderBy('display_order')->get();
        $dentalServices = $services->where('category', 'dental')->values();
        $whoWeAre = SiteContent::where('section_key', 'who_we_are')->first();

        return view('landing', [
            'services' => $services,
            'dentalServices' => $dentalServices,
            'whoWeAre' => $whoWeAre,
            'clinic' => config('clinic'),
        ]);
    }
}
