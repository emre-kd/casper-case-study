<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FormController;

use App\Models\Slide;
use App\Models\Product;
use App\Models\Form;

Route::get('/', function () {
    $slides = Slide::all();
    $products = Product::all();

    return Inertia::render('Welcome', [
        'slides' => $slides,
        'products' => $products
    ]);
})->name('home');

Route::get('/contact', function () {
    return Inertia::render('Contact', [
    ]);
})->name('contact');


Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('dashboard', function () {
    $slidesCount = Slide::count();
    $formsCount = Form::count();
    $productsCount = Product::count();
    return Inertia::render('Dashboard', [
        'slidesCount' => $slidesCount,
        'formsCount' => $formsCount,
        'productsCount' => $productsCount,
    ]);
})->name('dashboard');


Route::resource('slides', SlideController::class)->except(['update']);
Route::match(['put', 'post'], '/admin/slides/{id}', [SlideController::class, 'update'])->name('slides.update');

Route::resource('products', ProductController::class)->except(['update']);
Route::match(['put', 'post'], '/admin/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::resource('forms', FormController::class);



});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
