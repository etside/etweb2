@extends('layouts.admin')
@section('title','Products')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">All Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn-primary">+ Add Product</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($products as $p)
    <div class="glass-card rounded-xl p-4 hover:border-blue-500/30 transition-all flex flex-col">
        <!-- Logo/Image Preview -->
        <div class="w-full h-24 bg-black/20 rounded-lg mb-3 flex items-center justify-center overflow-hidden">
            @if($p->logo_url)
                <img src="{{ asset($p->logo_url) }}" alt="{{ $p->name }}" class="h-full object-contain">
            @elseif($p->image_url)
                <img src="{{ asset($p->image_url) }}" alt="{{ $p->name }}" class="h-full object-cover">
            @else
                <span class="text-4xl">📦</span>
            @endif
        </div>
        
        <!-- Product Info -->
        <h3 class="font-semibold text-sm mb-1 truncate">{{ $p->name }}</h3>
        <p class="text-xs" style="color:var(--muted);margin-bottom:auto;line-height:1.4">{{ Str::limit($p->description, 60) }}</p>
        
        <!-- Status Badge -->
        <div class="flex items-center justify-between mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.06)">
            <span class="text-xs px-2 py-0.5 rounded" style="{{ $p->is_active ? 'background:rgba(52,211,153,0.1);color:#34D399' : 'background:rgba(248,113,113,0.1);color:#F87171' }}">
                {{ $p->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        
        <!-- Actions -->
        <div class="flex items-center gap-2 mt-3">
            <a href="{{ route('admin.products.edit', $p) }}" class="flex-1 text-center px-3 py-1.5 rounded text-xs" style="background:rgba(38,132,255,0.1);color:#2684FF;border:1px solid rgba(38,132,255,0.2)">Edit</a>
            <form method="POST" action="{{ route('admin.products.destroy', $p) }}" class="flex-1" onsubmit="return confirm('Delete this product?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-full px-3 py-1.5 rounded text-xs btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@if(!$products->count())
<div class="text-center py-16">
    <p class="text-sm" style="color:var(--muted)">No products yet. <a href="{{ route('admin.products.create') }}" class="nav-link">Create one</a></p>
</div>
@endif
@endsection
