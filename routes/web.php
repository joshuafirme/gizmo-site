<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubcategoryController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WhoWeAreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/reviews', [PageController::class, 'reviews'])->name('reviews');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {


    Route::patch('messages/{message}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('messages.toggle-read');
    Route::resource('messages', ContactMessageController::class)->only(['index', 'destroy']);

    Route::patch('categories/{category}/toggle-status', [ProductCategoryController::class, 'toggleStatus'])
        ->name('categories.toggle-status');
    Route::resource('categories', ProductCategoryController::class)->except(['create', 'show', 'edit']);

    Route::patch('subcategories/{subcategory}/toggle-status', [ProductSubcategoryController::class, 'toggleStatus'])
        ->name('subcategories.toggle-status');
    Route::resource('subcategories', ProductSubcategoryController::class)->except(['create', 'show', 'edit']);

    Route::patch('products/{product}/toggle/{field}', [ProductController::class, 'toggleStatus'])->name('products.toggle');
    Route::resource('products', ProductController::class)->except(['create', 'show', 'edit']);

    Route::patch('sliders/{slider}/toggle-status', [HeroSliderController::class, 'toggleStatus'])->name('sliders.toggle-status');
    Route::resource('sliders', HeroSliderController::class)->except(['create', 'show', 'edit']);


    Route::patch('client-reviews/{slider}/toggle-status', [ClientReviewController::class, 'toggleStatus'])->name('client-reviews.toggle-status');
    Route::resource('client-reviews', ClientReviewController::class)->except(['create', 'show', 'edit']);

    Route::patch('who-we-are/toggle-status/{id}', [WhoWeAreController::class, 'toggleStatus'])->name('who-we-are.toggle-status');
    Route::resource('who-we-are', WhoWeAreController::class)->except(['create', 'show', 'edit']);
    Route::resource('about-us', AboutUsController::class)->except(['create', 'show', 'edit']);

    Route::get('settings', [SystemSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SystemSettingController::class, 'store'])->name('settings.store');

    Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);
});

use App\Http\Controllers\ContactController;

// Public form submission route
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});