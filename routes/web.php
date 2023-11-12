<?php

use App\Http\Controllers\CarouselController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsRelationController;
use App\Http\Controllers\TranslationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/about-us', [MainController::class, 'aboutUs'])->name('aboutUs');

//products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{url}', [ProductController::class, 'single'])->name('products.single');
Route::post('/products/ajax-get', [ProductController::class, 'ajaxGet'])->name('products.ajaxGet');

//news
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{url}', [NewsController::class, 'single'])->name('news.single');
Route::post('/news/ajax-get', [NewsController::class, 'ajaxGet'])->name('news.ajaxGet');

Route::post('/search', [MainController::class, 'search'])->name('search');
Route::post('/switch-locale', [LocaleController::class, 'switch'])->name('locale.switch');
Route::post('/email-feedback', [MainController::class, 'emailFeedback'])->name('email.feedback');


Route::group(['middleware' => 'auth'], function () {
    //products
    Route::get('/dashboard', [ProductController::class, 'dashboardIndex'])->name('dashboard.index');
    Route::get('/dashboard/products/create', [ProductController::class, 'dashboardCreate'])->name('dashboard.products.create');
    Route::get('/dashboard/products/{id}', [ProductController::class, 'dashboardSingle'])->name('dashboard.products.single');

    Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/remove', [ProductController::class, 'remove'])->name('products.remove');
    Route::post('/products/remove-multiple', [ProductController::class, 'removeMultiple'])->name('products.remove.multiple');

    //Product relations
    Route::get('/dashboard/product/relations', [ProductsRelationController::class, 'dashboardIndex'])->name('dashboard.products.relations.index');
    Route::get('/dashboard/product/relations/create', [ProductsRelationController::class, 'dashboardCreate'])->name('dashboard.products.relations.create');
    Route::get('/dashboard/product/relations/{id}', [ProductsRelationController::class, 'dashboardSingle'])->name('dashboard.products.relations.single');

    Route::post('/product/relations/update', [ProductsRelationController::class, 'update'])->name('products.relations.update');
    Route::post('/product/relations/store', [ProductsRelationController::class, 'store'])->name('products.relations.store');
    Route::post('/product/relations/remove', [ProductsRelationController::class, 'remove'])->name('products.relations.remove');
    Route::post('/product/relations/remove-multiple', [ProductsRelationController::class, 'removeMultiple'])->name('products.relations.remove.multiple');

    //news
    Route::get('/dashboard/news', [NewsController::class, 'dashboardIndex'])->name('dashboard.news.index');
    Route::get('/dashboard/news/create', [NewsController::class, 'dashboardCreate'])->name('dashboard.news.create');
    Route::get('/dashboard/news/{id}', [NewsController::class, 'dashboardSingle'])->name('dashboard.news.single');

    Route::post('/news/update', [NewsController::class, 'update'])->name('news.update');
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::post('/news/remove', [NewsController::class, 'remove'])->name('news.remove');
    Route::post('/news/remove-multiple', [NewsController::class, 'removeMultiple'])->name('news.remove.multiple');

    //News categories
    Route::get('/dashboard/news-categories', [NewsCategoryController::class, 'dashboardIndex'])->name('dashboard.news.categories.index');
    Route::get('/dashboard/news-categories/create', [NewsCategoryController::class, 'dashboardCreate'])->name('dashboard.news.categories.create');
    Route::get('/dashboard/news-categories/{id}', [NewsCategoryController::class, 'dashboardSingle'])->name('dashboard.news.categories.single');

    Route::post('/news-categories/update', [NewsCategoryController::class, 'update'])->name('news.categories.update');
    Route::post('/news-categories/store', [NewsCategoryController::class, 'store'])->name('news.categories.store');
    Route::post('/news-categories/remove', [NewsCategoryController::class, 'remove'])->name('news.categories.remove');
    Route::post('/news-categories/remove-multiple', [NewsCategoryController::class, 'removeMultiple'])->name('news.categories.remove.multiple');

    //options
    Route::get('/dashboard/options', [OptionController::class, 'dashboardIndex'])->name('dashboard.options.index');
    Route::get('/dashboard/options/{id}', [OptionController::class, 'dashboardSingle'])->name('dashboard.options.single');
    Route::post('/options/update', [OptionController::class, 'update'])->name('options.update');

    //translations
    Route::get('/dashboard/translations', [TranslationController::class, 'dashboardIndex'])->name('dashboard.translations.index');
    Route::get('/dashboard/translations/{tag}', [TranslationController::class, 'dashboardSingle'])->name('dashboard.translations.single');
    Route::post('/translations/update', [TranslationController::class, 'update'])->name('translations.update');

    //slider
    Route::get('/dashboard/carousel', [CarouselController::class, 'dashboardIndex'])->name('dashboard.carousel.index');
    Route::get('/dashboard/carousel/create-item', [CarouselController::class, 'dashboardCreate'])->name('dashboard.carousel.create');
    Route::get('/dashboard/carousel/item/{id}', [CarouselController::class, 'dashboardSingle'])->name('dashboard.carousel.single');

    Route::post('/carousel-item/update', [CarouselController::class, 'update'])->name('carousel.update');
    Route::post('/carousel-item/store', [CarouselController::class, 'store'])->name('carousel.store');
    Route::post('/carousel-item/remove', [CarouselController::class, 'remove'])->name('carousel.remove');
    Route::post('/carousel-item/remove-multiple', [CarouselController::class, 'removeMultiple'])->name('carousel.remove.multiple');

    //locale
    Route::get('/dashboard/locale', [LocaleController::class, 'dashboardIndex'])->name('dashboard.locale.index');
    Route::post('/locales/update/switcher', [LocaleController::class, 'updateSwitcher'])->name('locale.update.switcher');
});

Route::fallback([MainController::class, 'notFound']);

require_once __DIR__.'/auth.php';
