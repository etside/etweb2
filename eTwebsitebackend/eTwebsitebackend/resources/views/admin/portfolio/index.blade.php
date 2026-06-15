@extends('layouts.admin')
@section('title','Portfolio')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">Portfolio Items</h2>
    <a href="{{ route('admin.portfolio.create') }}" class="btn-primary">+ Add Portfolio Item</a>
</div>
<div class="space-y-2">
    @foreach($portfolioItems as $item)
    <div class="glass-card rounded-xl p-4 flex items-start justify-between">
        <div class="flex items-center gap-3 flex-1">
            <div class="w-16 h-16 rounded-lg overflow-hidden shrink-0 flex-shrink-0">
                @if($item->image_url)
                <img src="{{ asset($item->image_url) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full gradient-bg flex items-center justify-center text-white font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif
            </div>
            <div class="flex-1">
                <p class="font-medium text-sm">{{ $item->title }}</p>
                <p class="text-xs" style="color:var(--muted)">{{ $item->category }}</p>
                <p class="text-xs" style="color:var(--muted)">{{ $item->client_name ? 'Client: ' . $item->client_name : 'No client info' }}</p>
                @if($item->featured)
                <span class="inline-block text-xs px-2 py-1 rounded mt-1" style="background:rgba(39,174,96,.1);color:#27AE60">Featured</span>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('admin.portfolio.edit', $item) }}" class="text-xs" style="color:#2684FF">Edit</a>
            <form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button></form>
        </div>
    </div>
    @endforeach
    @if(!$portfolioItems->count())<p class="text-center py-10 text-sm" style="color:var(--muted)">No portfolio items yet.</p>@endif
</div>
@endsection
