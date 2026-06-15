@extends('layouts.admin')
@section('title', isset($project->id) ? 'Edit Project' : 'New Project')
@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.projects.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back</a>
    <div class="glass-card rounded-xl p-6">
        <h2 class="font-semibold mb-6 text-sm">{{ isset($project->id) ? 'Edit Project' : 'New Project' }}</h2>
        <form method="POST"
              action="{{ isset($project->id) ? route('admin.projects.update',$project) : route('admin.projects.store') }}"
              enctype="multipart/form-data" class="space-y-4">
            @csrf @if(isset($project->id)) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Project Name *</label>
                    <input type="text" name="name" value="{{ old('name',$project->name) }}" class="admin-input" required>
                </div>
                <div>
                    <label class="form-label">Category</label>
                    <input type="text" name="category" value="{{ old('category',$project->category) }}" class="admin-input" placeholder="Web App, Mobile, ERP…">
                </div>
            </div>

            <div>
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="admin-input">{{ old('description',$project->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Live URL</label>
                    <input type="url" name="url" value="{{ old('url',$project->url) }}" class="admin-input" placeholder="https://…">
                </div>
                <div>
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order',$project->display_order??0) }}" class="admin-input">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Logo</label>
                    @if($project->logo_url)<img src="{{ asset($project->logo_url) }}" class="h-10 mb-2 rounded object-contain bg-white/5 px-2">@endif
                    <input type="file" name="logo" accept="image/*" class="admin-input">
                </div>
                <div>
                    <label class="form-label">Cover Image <span style="color:var(--muted);font-weight:400">(hero/thumbnail)</span></label>
                    @if($project->cover_image)<img src="{{ asset($project->cover_image) }}" class="h-10 mb-2 rounded object-cover w-full">@endif
                    <input type="file" name="cover_image" accept="image/*" class="admin-input">
                </div>
            </div>

            <div>
                <label class="form-label">Screenshots <span style="color:var(--muted);font-weight:400">(multi-select, appended)</span></label>
                @if(count($project->screenshots??[]))
                <div class="flex flex-wrap gap-2 mb-2">
                    @foreach($project->screenshots as $s)<img src="{{ asset($s) }}" class="h-16 rounded object-cover">@endforeach
                </div>
                @endif
                <input type="file" name="screenshots[]" accept="image/*" multiple class="admin-input">
            </div>

            <div>
                <label class="form-label">Tech Stack <span style="color:var(--muted);font-weight:400">(comma-separated)</span></label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack',$project->tech_stack) }}" class="admin-input" placeholder="Laravel, React, Flutter…">
            </div>

            <div>
                <label class="form-label">Features <span style="color:var(--muted);font-weight:400">(one per line)</span></label>
                <textarea name="features" rows="4" class="admin-input">{{ old('features',$project->features) }}</textarea>
            </div>

            <div class="rounded-lg p-4 space-y-3" style="background:rgba(38,132,255,0.06);border:1px solid rgba(38,132,255,0.15)">
                <p class="text-xs font-semibold" style="color:#2684FF">🔒 Login Credentials <span class="font-normal" style="color:var(--muted)">(admin-only)</span></p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Username / Email</label>
                        <input type="text" name="login_username" value="{{ old('login_username',$project->login_username) }}" class="admin-input" autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label">Password</label>
                        <div class="relative">
                            <input type="password" name="login_password" id="lpwd" value="{{ old('login_password',$project->login_password) }}" class="admin-input pr-10" autocomplete="new-password">
                            <button type="button" onclick="document.getElementById('lpwd').type==='password'?document.getElementById('lpwd').type='text':document.getElementById('lpwd').type='password'" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs" style="color:var(--muted)">Show</button>
                        </div>
                    </div>
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active',$project->is_active??true)?'checked':'' }}>
                Active (visible on portfolio)
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ isset($project->id)?'Update':'Create' }}</button>
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
