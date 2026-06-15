<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');
        
        $query = PortfolioItem::query();
        
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        
        $portfolioItems = $query->ordered()->get();
        $categories = PortfolioItem::getCategories();
        
        $stats = [
            ['label' => 'Projects Completed', 'value' => PortfolioItem::count()],
            ['label' => 'Happy Clients', 'value' => '100+'],
            ['label' => 'Countries Served', 'value' => '26+'],
        ];

        if ($request->wantsJson()) {
            return response()->json([
                'items' => $portfolioItems,
                'categories' => $categories,
            ]);
        }

        return view('portfolio.index', compact('portfolioItems', 'categories', 'stats', 'category'));
    }

    public function show(PortfolioItem $portfolioItem)
    {
        return view('portfolio.show', compact('portfolioItem'));
    }
}
