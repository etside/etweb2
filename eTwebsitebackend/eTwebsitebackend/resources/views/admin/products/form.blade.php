@extends('layouts.admin')
@section('title', isset($product->id) ? 'Edit Product' : 'New Product')
@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.products.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back</a>
    <div class="glass-card rounded-xl p-6">
        <h2 class="font-semibold mb-6 text-sm">{{ isset($product->id) ? 'Edit Product' : 'New Product' }}</h2>
        <form method="POST" action="{{ isset($product->id) ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @if(isset($product->id)) @method('PUT') @endif
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="admin-input" required>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Description</label>
                <textarea name="description" rows="4" class="admin-input">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', $product->icon) }}" class="admin-input" placeholder="e.g., fas fa-box">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $product->display_order ?? 0) }}" class="admin-input">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Product Image (up to 2MB)</label>
                    @if(isset($product->image_url) && $product->image_url)
                    <div class="mb-2">
                        <img src="{{ asset($product->image_url) }}" class="w-24 h-24 rounded object-cover">
                    </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Product Logo (up to 2MB)</label>
                    @if(isset($product->logo_url) && $product->logo_url)
                    <div class="mb-2">
                        <img src="{{ asset($product->logo_url) }}" class="w-16 h-16 rounded object-contain">
                    </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="admin-input">
                </div>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">External URL</label>
                <input type="text" name="external_url" value="{{ old('external_url', $product->external_url) }}" class="admin-input">
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>Active
            </label>
            <div class="flex gap-3 pt-4 border-t" style="border-color:var(--border)">
                <button type="submit" class="btn-primary">{{ isset($product->id) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
