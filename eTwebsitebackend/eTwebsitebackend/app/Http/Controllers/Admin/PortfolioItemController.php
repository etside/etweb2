<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use App\Traits\HandleFileUploads;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{
    use HandleFileUploads;

    public function index()
    {
        $portfolioItems = PortfolioItem::orderBy('sort_order')->get();
        return view('admin.portfolio.index', compact('portfolioItems'));
    }

    public function create()
    {
        $categories = PortfolioItem::distinct('category')->pluck('category')->toArray();
        return view('admin.portfolio.form', ['portfolioItem' => new PortfolioItem(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'client_name' => 'nullable|max:255',
            'category' => 'required|max:100',
            'image' => 'nullable|image|max:5120',
            'logo' => 'nullable|image|max:2048',
            'external_link' => 'nullable|url',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $slug = \Illuminate\Support\Str::slug($request->title) ?? 'item-' . time();
        $data['slug'] = $slug;
        $data['featured'] = $request->boolean('featured');

        $files = $this->uploadFiles($request, ['image', 'logo'], 'portfolio');
        if ($files['image'] ?? null) $data['image_url'] = $files['image'];
        if ($files['logo'] ?? null) $data['logo_url'] = $files['logo'];

        unset($data['image'], $data['logo']);

        PortfolioItem::create($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item created.');
    }

    public function edit(PortfolioItem $portfolioItem)
    {
        $categories = PortfolioItem::distinct('category')->pluck('category')->toArray();
        return view('admin.portfolio.form', compact('portfolioItem', 'categories'));
    }

    public function update(Request $request, PortfolioItem $portfolioItem)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'client_name' => 'nullable|max:255',
            'category' => 'required|max:100',
            'image' => 'nullable|image|max:5120',
            'logo' => 'nullable|image|max:2048',
            'external_link' => 'nullable|url',
            'featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $data['featured'] = $request->boolean('featured');

        $files = $this->uploadFiles($request, ['image', 'logo'], 'portfolio');
        if ($files['image'] ?? null) $data['image_url'] = $files['image'];
        if ($files['logo'] ?? null) $data['logo_url'] = $files['logo'];

        unset($data['image'], $data['logo']);

        $portfolioItem->update($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item updated.');
    }

    public function destroy(PortfolioItem $portfolioItem)
    {
        $portfolioItem->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Deleted.');
    }
}
