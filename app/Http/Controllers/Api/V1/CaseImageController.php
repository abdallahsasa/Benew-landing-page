<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseImageRequest;
use App\Http\Requests\UpdateCaseImageRequest;
use App\Http\Resources\CaseImageResource;
use App\Models\CaseImage;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class CaseImageController extends Controller
{
    public function store(StoreCaseImageRequest $request, Service $service): JsonResponse
    {
        $created = [];
        $nextOrder = (int) $service->caseImages()->max('sort_order') + 1;

        foreach ($request->file('images') as $file) {
            $path = $file->store('cases/' . $service->slug, 'public');
            $created[] = CaseImage::create([
                'service_id' => $service->id,
                'image_path' => $path,
                'caption' => $request->input('caption'),
                'sort_order' => $nextOrder++,
            ]);
        }

        return response()->json([
            'message' => 'Case image(s) uploaded successfully.',
            'data' => CaseImageResource::collection(collect($created)),
        ], 201);
    }

    public function update(UpdateCaseImageRequest $request, CaseImage $caseImage): CaseImageResource
    {
        $caseImage->update($request->validated());
        return new CaseImageResource($caseImage);
    }

    public function destroy(CaseImage $caseImage): JsonResponse
    {
        if (Storage::disk('public')->exists($caseImage->image_path)) {
            Storage::disk('public')->delete($caseImage->image_path);
        }
        $caseImage->delete();

        return response()->json(['message' => 'Case image deleted.']);
    }
}
