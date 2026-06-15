<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, ServiceController, ProductController, BlogController, AboutController, ContactController, GptController, PortfolioController, FaqController, CareersController, IndustryController, ServiceDetailController};
use App\Http\Controllers\Admin;

// ChatGPT plugin discovery
Route::get('/.well-known/ai-plugin.json', [GptController::class, 'manifest']);
Route::get('/api/openapi.json', [GptController::class, 'openapi']);

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceDetailController::class, 'show'])->name('services.show');
Route::get('/industries', [IndustryController::class, 'index'])->name('industries');
Route::get('/industries/{slug}', [IndustryController::class, 'show'])->name('industry.show');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{portfolioItem}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/careers', [CareersController::class, 'index'])->name('careers');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Legal pages
Route::get('/privacy', fn() => view('privacy'))->name('privacy');
Route::get('/terms', fn() => view('terms'))->name('terms');

// Breeze auth routes
require __DIR__.'/auth.php';

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('services', Admin\ServiceController::class);
    Route::resource('products', Admin\ProductController::class);
    Route::resource('portfolio', Admin\PortfolioItemController::class);
    Route::resource('blog', Admin\BlogPostController::class);
    Route::resource('team', Admin\TeamMemberController::class);
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::resource('logos', Admin\ClientLogoController::class);
    Route::resource('projects', Admin\ProjectController::class);
    Route::get('submissions', [Admin\SubmissionController::class, 'index'])->name('submissions.index');
    Route::patch('submissions/{submission}', [Admin\SubmissionController::class, 'markRead'])->name('submissions.markRead');
    Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
});
