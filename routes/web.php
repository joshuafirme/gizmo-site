<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubcategoryController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Admin\WhoWeAreController;
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


Route::get('/', function () {
    return view('site.main');
});

Route::prefix('admin')->name('admin.')->group(function () {

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

    Route::resource('who-we-are', WhoWeAreController::class)->except(['create', 'show', 'edit']);
    Route::resource('about-us', AboutUsController::class)->except(['create', 'show', 'edit']);

    Route::get('settings', [SystemSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SystemSettingController::class, 'store'])->name('settings.store');
});


Route::get('/admin', function () {
    return view('admin.dashboard');
});




Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');