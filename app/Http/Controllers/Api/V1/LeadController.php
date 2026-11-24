<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadStatusRequest;
use App\Http\Resources\LeadResource;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request): JsonResponse
    {
        $lead = Lead::create($request->validated());

        return response()->json([
            'message' => 'Thank you! Our Benew team will contact you shortly.',
            'data' => new LeadResource($lead),
        ], 201);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Lead::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        if ($request->filled('service')) {
            $query->where('service_interest', $request->string('service'));
        }
        if ($request->filled('search')) {
            $term = '%' . $request->string('search') . '%';
            $query->where(function ($q) use ($term) {
                $q->where('full_name', 'like', $term)
                  ->orWhere('phone', 'like', $term)
                  ->orWhere('email', 'like', $term);
            });
        }

        return LeadResource::collection($query->paginate(25));
    }

    public function updateStatus(UpdateLeadStatusRequest $request, Lead $lead): LeadResource
    {
        $lead->update(['status' => $request->validated('status')]);
        return new LeadResource($lead);
    }

    public function exportCsv(): StreamedResponse
    {
        $leads = Lead::latest()->get();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="benew-leads-' . now()->format('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () use ($leads) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Full Name', 'Phone', 'Email', 'Service', 'Status', 'UTM Source', 'UTM Campaign', 'FBCLID', 'Message', 'Created At']);
            foreach ($leads as $lead) {
                fputcsv($handle, [
                    $lead->id, $lead->full_name, $lead->phone, $lead->email,
                    $lead->service_interest, $lead->status, $lead->utm_source,
                    $lead->utm_campaign, $lead->fbclid, $lead->message, $lead->created_at,
                ]);
            }
            fclose($handle);
        }, 200, $headers);
    }
}
