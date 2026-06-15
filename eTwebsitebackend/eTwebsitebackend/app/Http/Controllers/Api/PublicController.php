<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Service, Product, Project, BlogPost, TeamMember, Testimonial, ClientLogo, ContactSubmission};
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function services()
    {
        return Service::where('is_active', true)->orderBy('display_order')->get();
    }

    public function products()
    {
        return Product::where('is_active', true)->orderBy('display_order')->get();
    }

    public function blog()
    {
        return BlogPost::where('is_published', true)
            ->orderByDesc('published_at')
            ->get(['id','slug','title','excerpt','category','cover_image','published_at','is_published']);
    }

    public function blogPost($slug)
    {
        $post = BlogPost::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return $post;
    }

    public function team()
    {
        return TeamMember::where('is_active', true)->orderBy('display_order')->get();
    }

    public function testimonials()
    {
        return Testimonial::where('is_active', true)->orderBy('display_order')->get();
    }

    public function logos()
    {
        return ClientLogo::where('is_active', true)->orderBy('display_order')->get();
    }

    public function projects()
    {
        return Project::where('is_active', true)->orderBy('display_order')
            ->get(['id','name','category','description','url','logo_url','cover_image','screenshots','features','tech_stack']);
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|max:255',
            'message' => 'required',
            'phone'   => 'nullable|max:30',
        ]);

        ContactSubmission::create($data);

        return response()->json(['message' => 'Message sent successfully']);
    }
}
