@extends('layouts.admin')
@section('title', isset($portfolioItem->id) ? 'Edit Portfolio Item' : 'Add Portfolio Item')
@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.portfolio.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back</a>
    <div class="glass-card rounded-xl p-6">
        <h2 class="font-semibold mb-6 text-sm">{{ isset($portfolioItem->id) ? 'Edit Portfolio Item' : 'New Portfolio Item' }}</h2>
        <form method="POST" action="{{ isset($portfolioItem->id) ? route('admin.portfolio.update', $portfolioItem) : route('admin.portfolio.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @if(isset($portfolioItem->id)) @method('PUT') @endif
            
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Title *</label>
                <input type="text" name="title" value="{{ old('title', $portfolioItem->title) }}" class="admin-input" required>
            </div>

            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Description</label>
                <textarea name="description" rows="4" class="admin-input">{{ old('description', $portfolioItem->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Category *</label>
                    <select name="category" class="admin-input" required>
                        <option value="">Select or type category...</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $portfolioItem->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                        <option value="__new__">+ Add New Category</option>
                    </select>
                    <input type="text" id="new-category" name="new_category" class="admin-input mt-2" placeholder="Enter new category name" style="display:none;">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Client Name</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $portfolioItem->client_name) }}" class="admin-input">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Project Image (up to 5MB)</label>
                    @if(isset($portfolioItem->image_url) && $portfolioItem->image_url)
                    <div class="mb-2">
                        <img src="{{ asset($portfolioItem->image_url) }}" class="w-32 h-24 rounded object-cover">
                    </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Project Logo (up to 2MB)</label>
                    @if(isset($portfolioItem->logo_url) && $portfolioItem->logo_url)
                    <div class="mb-2">
                        <img src="{{ asset($portfolioItem->logo_url) }}" class="w-20 h-20 rounded object-contain">
                    </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="admin-input">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">External Link (URL)</label>
                    <input type="url" name="external_link" value="{{ old('external_link', $portfolioItem->external_link) }}" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $portfolioItem->sort_order ?? 0) }}" class="admin-input">
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="featured" value="1" {{ old('featured', $portfolioItem->featured ?? false) ? 'checked' : '' }}>
                Featured Project
            </label>

            <div class="flex gap-3 pt-4 border-t" style="border-color:var(--border)">
                <button type="submit" class="btn-primary">{{ isset($portfolioItem->id) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.portfolio.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelector('select[name="category"]').addEventListener('change', function(e) {
    const newCatInput = document.getElementById('new-category');
    if (e.target.value === '__new__') {
        newCatInput.style.display = 'block';
        newCatInput.required = true;
    } else {
        newCatInput.style.display = 'none';
        newCatInput.required = false;
    }
});
</script>
@endsection
