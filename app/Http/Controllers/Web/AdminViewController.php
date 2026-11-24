<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SiteContent;
use Illuminate\View\View;

class AdminViewController extends Controller
{
    public function login(): View
    {
        return view('admin.login');
    }

    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'services' => Service::with('caseImages')->orderBy('display_order')->get(),
            'whoWeAre' => SiteContent::where('section_key', 'who_we_are')->first(),
        ]);
    }
}
