<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MCPLead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    /**
     * Store a newly created lead in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:mcp_leads',
            'name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'service_interest' => 'nullable|string|max:255',
            'budget_range' => 'nullable|string|max:50',
            'conversation_summary' => 'nullable|string',
            'platform_source' => 'nullable|in:chatgpt,tencent,claude,slack,github,web',
            'status' => 'nullable|in:new,contacted,qualified,proposal,converted,rejected',
        ]);

        $lead = MCPLead::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lead captured successfully',
            'data' => $lead,
        ], 201);
    }

    /**
     * Display the specified lead.
     */
    public function show(MCPLead $lead): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $lead,
        ]);
    }

    /**
     * Update the specified lead in storage.
     */
    public function update(Request $request, MCPLead $lead): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'nullable|in:new,contacted,qualified,proposal,converted,rejected',
            'lead_score' => 'nullable|integer|min:0|max:100',
            'name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'service_interest' => 'nullable|string|max:255',
            'budget_range' => 'nullable|string|max:50',
            'conversation_summary' => 'nullable|string',
        ]);

        $lead->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lead updated successfully',
            'data' => $lead,
        ]);
    }

    /**
     * Get leads by platform.
     */
    public function byPlatform(Request $request, $platform): JsonResponse
    {
        $leads = MCPLead::byPlatform($platform)
            ->latest()
            ->limit($request->get('limit', 10))
            ->get();

        return response()->json([
            'success' => true,
            'platform' => $platform,
            'total' => $leads->count(),
            'data' => $leads,
        ]);
    }

    /**
     * Get qualified leads.
     */
    public function qualified(Request $request): JsonResponse
    {
        $threshold = $request->get('threshold', 50);

        $leads = MCPLead::qualified($threshold)
            ->latest()
            ->limit($request->get('limit', 20))
            ->get();

        return response()->json([
            'success' => true,
            'threshold' => $threshold,
            'total' => $leads->count(),
            'data' => $leads,
        ]);
    }
}
