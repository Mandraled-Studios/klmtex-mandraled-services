<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SecondarySubcategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/cache', function () {
    \Artisan::call('optimize');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    return redirect(route('dashboard'));
});

Route::get('/link', function () {
    //dd(storage_path('app/public'));
    //dd(public_path()."uploads");
    symlink(storage_path('app/public'), public_path()."storage");
    return redirect(route('dashboard'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // All Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{cat}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::patch('/categories/{cat}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{cat}', [CategoryController::class, 'delete'])->name('categories.delete');
    
    // All Sub Category Routes
    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories');
    Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/subcategories/{subcat}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::get('/subcategories/search', [SubcategoryController::class, 'search'])->name('subcategories.search');
    Route::patch('/subcategories/{subcat}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/subcategories/{subcat}', [SubcategoryController::class, 'delete'])->name('subcategories.delete');

    // All Secondary Sub Category Routes
    Route::get('/secondary-subcategories', [SecondarySubcategoryController::class, 'index'])->name('secondary-subcategories');
    Route::get('/secondary-subcategories/create', [SecondarySubcategoryController::class, 'create'])->name('secondary-subcategories.create');
    Route::post('/secondary-subcategories', [SecondarySubcategoryController::class, 'store'])->name('secondary-subcategories.store');
    Route::get('/secondary-subcategories/{secsubcat}/edit', [SecondarySubcategoryController::class, 'edit'])->name('secondary-subcategories.edit');
    Route::get('/secondary-subcategories/search', [SecondarySubcategoryController::class, 'search'])->name('secondary-subcategories.search');
    Route::patch('/secondary-subcategories/{secsubcat}', [SecondarySubcategoryController::class, 'update'])->name('secondary-subcategories.update');
    Route::delete('/secondary-subcategories/{secsubcat}', [SecondarySubcategoryController::class, 'delete'])->name('secondary-subcategories.delete');
    
    // All Collection Related Routes
    Route::get('/collections', [CollectionController::class, 'index'])->name('collections');
    Route::get('/collections/create', [CollectionController::class, 'create'])->name('collections.create');
    Route::post('/collections', [CollectionController::class, 'store'])->name('collections.store');

    // All Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('products.delete');
    
    // All Product Variant Routes
    Route::get('/products/{id}/variants', [VariantsController::class, 'index'])->name('products.variants.index');
    Route::get('/products/{id}/variants/create', [VariantsController::class, 'create'])->name('products.variants.create');
    Route::post('/products/{id}/variants', [VariantsController::class, 'store'])->name('products.variants.store');
    Route::get('/products/{id}/variants/{vid}/edit', [VariantsController::class, 'edit'])->name('products.variants.edit');
    Route::patch('/products/{id}/variants/{vid}', [VariantsController::class, 'update'])->name('products.variants.update');
    Route::delete('/products/{id}/variants/{vid}/', [VariantsController::class, 'delete'])->name('products.variants.delete');

    // All Stock Routes
    Route::get('/products/{id}/inventory', [InventoryController::class, 'index'])->name('products.stock.index');
    Route::get('/products/{id}/inventory/create', [InventoryController::class, 'create'])->name('products.stock.create');
    Route::post('/products/{id}/inventory', [InventoryController::class, 'store'])->name('products.stock.store');
    Route::get('/products/{id}/inventory/edit', [InventoryController::class, 'edit'])->name('products.stock.edit');
    Route::patch('/products/{id}/inventory/{skuid}', [InventoryController::class, 'update'])->name('products.stock.update');
    Route::delete('/products/{id}/inventory/{skuid}', [InventoryController::class, 'delete'])->name('products.stock.delete');
    
    //All Highlights Routes
    Route::get('/products/{id}/highlights/create', [HighlightController::class, 'index'])->name('products.highlights.index');
    Route::post('/products/{id}/highlights', [HighlightController::class, 'store'])->name('products.highlights.store');
    Route::delete('/products/{id}/highlights/{hid}', [HighlightController::class, 'delete'])->name('products.highlights.delete');

    //All Banner Routes
    Route::get('/products/{id}/banners/create', [BannerController::class, 'index'])->name('products.banners.index');
    Route::post('/products/{id}/banners', [BannerController::class, 'store'])->name('products.banners.store');
    Route::delete('/products/{id}/banners/{bid}', [BannerController::class, 'delete'])->name('products.banners.delete');

    //All Attributes Routes
    Route::get('/products/{id}/attributes/create', [AttributeController::class, 'index'])->name('products.attributes.index');
    Route::post('/products/{id}/attributes', [AttributeController::class, 'store'])->name('products.attributes.store');
    Route::delete('/products/{id}/attributes/{aid}', [AttributeController::class, 'delete'])->name('products.attributes.delete');

    //All Offers Routes
    Route::get('/products/{id}/offers/create', [OfferController::class, 'index'])->name('products.offers.index');
    Route::post('/products/{id}/offers', [OfferController::class, 'store'])->name('products.offers.store');
    Route::delete('/products/{id}/offers/{oid}', [OfferController::class, 'delete'])->name('products.offers.delete');

    //All Attachments Routes
    Route::get('/products/{id}/attachments/create', [AttachmentController::class, 'index'])->name('products.attachments.index');
    Route::post('/products/{id}/attachments', [AttachmentController::class, 'store'])->name('products.attachments.store');
    Route::delete('/products/{id}/attachments', [AttachmentController::class, 'delete'])->name('products.attachments.delete');
    
    // All Inventory Routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    
    // All Settings Related Routes
    Route::get('/store-setup', [StoreController::class, 'index'])->name('store');
    
    // All Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    
    // All Payment Routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    
    // All Reviews & Ratings Routes
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
    
    // All Support Routes
    Route::get('/support', [SupportController::class, 'index'])->name('support');
});
