<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecommendationController extends Controller
{
    /**
     * Recommend services based on business type and challenges
     */
    public function recommendServices(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'business_type' => 'required|string',
            'challenges' => 'required|array',
            'challenges.*' => 'string',
            'max_results' => 'nullable|integer|max:20',
        ]);

        $maxResults = $validated['max_results'] ?? 5;
        $businessType = strtolower($validated['business_type']);
        $challenges = array_map('strtolower', $validated['challenges']);

        // Get all services
        $services = Service::where('status', 'active')->get();

        // Score services based on relevance
        $scored = $services->map(function ($service) use ($businessType, $challenges) {
            $score = 0;

            // Check if service category matches business type
            if (stripos($service->category, $businessType) !== false) {
                $score += 30;
            }

            // Check if service description contains challenge keywords
            $description = strtolower($service->description);
            foreach ($challenges as $challenge) {
                if (stripos($description, $challenge) !== false) {
                    $score += 20;
                }
            }

            return [
                'service' => $service,
                'score' => $score,
            ];
        });

        // Sort by score and take top results
        $recommendations = $scored
            ->sortByDesc('score')
            ->take($maxResults)
            ->values()
            ->map(function ($item) {
                return [
                    'id' => $item['service']->id,
                    'name' => $item['service']->name,
                    'description' => $item['service']->description,
                    'category' => $item['service']->category,
                    'relevance_score' => $item['score'],
                ];
            });

        return response()->json([
            'success' => true,
            'business_type' => $businessType,
            'total_recommendations' => $recommendations->count(),
            'data' => $recommendations,
        ]);
    }

    /**
     * Recommend products based on use case and budget
     */
    public function recommendProducts(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'use_case' => 'nullable|string',
            'budget' => 'nullable|string',
            'max_results' => 'nullable|integer|max:20',
        ]);

        $maxResults = $validated['max_results'] ?? 5;
        $useCase = strtolower($validated['use_case'] ?? '');
        $budget = $validated['budget'] ?? null;

        $query = Product::where('status', 'active');

        // Filter by budget if provided
        if ($budget && is_numeric($budget)) {
            $query->where('price', '<=', (float)$budget);
        }

        $products = $query->get();

        // Score products
        $scored = $products->map(function ($product) use ($useCase) {
            $score = $product->popularity ?? 0;

            if ($useCase && stripos($product->description, $useCase) !== false) {
                $score += 50;
            }

            return [
                'product' => $product,
                'score' => $score,
            ];
        });

        $recommendations = $scored
            ->sortByDesc('score')
            ->take($maxResults)
            ->values()
            ->map(function ($item) {
                return [
                    'id' => $item['product']->id,
                    'name' => $item['product']->name,
                    'description' => $item['product']->description,
                    'price' => $item['product']->price,
                    'relevance_score' => $item['score'],
                ];
            });

        return response()->json([
            'success' => true,
            'use_case' => $useCase,
            'budget_filter' => $budget,
            'total_recommendations' => $recommendations->count(),
            'data' => $recommendations,
        ]);
    }
}
