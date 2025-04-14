<?php

use App\Models\Site;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminApprovalController;

// Tenant site home via subdomain routing
Route::domain('{subdomain}.courierplus.test')->group(function () {
    Route::get('/', function ($subdomain) {
        $site = Site::where('subdomain', $subdomain)->firstOrFail();
        $posts = $site->posts()->with('user')->latest()->paginate(15);

        return view('public.sites.home', [
            'site' => $site,
            'posts' => $posts,
        ]);
    })->name('site.home');
});

// Public & Authenticated Routes
Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('sites/manage/{site}', 'sites.manage')
    ->middleware(['auth', 'verified'])
    ->name('sites.manage');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->post('/admin/approve-user/{user}', AdminApprovalController::class)
    ->name('admin.approve-user');


require __DIR__.'/auth.php';
