<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteContentRequest;
use App\Http\Resources\SiteContentResource;
use App\Models\SiteContent;

class SiteContentController extends Controller
{
    public function show(string $sectionKey): SiteContentResource
    {
        $content = SiteContent::where('section_key', $sectionKey)->firstOrFail();
        return new SiteContentResource($content);
    }

    public function update(UpdateSiteContentRequest $request, string $sectionKey): SiteContentResource
    {
        $content = SiteContent::updateOrCreate(
            ['section_key' => $sectionKey],
            $request->validated()
        );

        return new SiteContentResource($content);
    }
}
