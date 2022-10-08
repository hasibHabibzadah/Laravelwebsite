<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\ContactMe;
use App\Http\Controllers\Home\FooterController;
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
//Admin all routes
Route::middleware(['web'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/logout','destroy')->name('admin.logout');
        Route::get('/admin/profile','profile')->name('admin.profile');
        Route::get('/edit/profile','editprofile')->name('edit.profile');
        Route::post('/store/profile','StoreProfile')->name('store.profile');

        Route::get("/change/password",'ChangePassword')->name('change.password')->middleware('auth');
        Route::post('/update/password','UpdatePassword')->name('update.password');
    });
});


// Home Slider Controller
Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home/slide/','HomeSlider')->name('home.slide');
    Route::post('/update/slider', 'UpdateSlider')->name('update.slider');

});


// multi image routes
Route::get("/all/multi/image",[AboutController::class,'allMultiImage'])->name('all.multi.image');
Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page','aboutPage')->name('about.page');
    Route::post('/update/page','updateAbout')->name('update.about');
    Route::get('/about','homeAbout')->name('home.about');
    Route::get('/about/multi/image','AboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image','storeMultiImage')->name('store.multi.image');
    Route::get('/edit/multi/image/{id}','editMultiImage')->name('edit.multi.image');
    Route::post('/update/multi/image','updateMultiImage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}','deleteMultiImage')->name('delete.multi.image');
});
// *********************** ///////
// Portfolio section routes 
Route::controller(PortfolioController::class)->group(function () {
    Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');
    Route::get('/add/portfolio', 'addPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio', 'storePortfolio')->name('store.portfolio');
    Route::get('/edit/portfolio/{id}', 'editPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio', 'updatePortfolio')->name('update.portfolio');
    Route::get('/delete/portfolio/{id}', 'deletePortfolio')->name('delete.portfolio');
    Route::get('/details/portfolio/{id}', 'detailsPortfolio')->name('portfolio.details');
    Route::get('/portfolio', 'homePortfolio')->name('home.portfolio');
    
});

// Blog category all routes 
Route::controller(BlogCategoryController::class)->group(function(){
    Route::get("/all/blog/category",'AllBlogCotegory')->name("all.blog.category");
    Route::get('/add/blog/category', 'AddBlogCategory')->name('add.blog.category');

    Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');

    Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');

     Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')->name('update.blog.category');

     Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
});

// BLOG 
Route::controller(BlogController::class)->group(function () {
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get("/add/blog",'addBlog')->name('add.blog');
    Route::post("/store/blog",'storeBlog')->name('store.blog');
    Route::get("/edit/blog/{id}",'editBlog')->name('edit.blog');
    Route::post("/update/blog",'updateBlog')->name('update.blog');
    Route::get("/delete/blog/{id}",'deleteBlog')->name('delete.blog');
    Route::get('/blog/details/{id}', 'BlogDetails')->name('blog.details');
    Route::get('/category/blog/{id}', 'CategoryBlog')->name('category.blog');
    Route::get('/blog', 'HomeBlog')->name('home.blog');
});
// FOOTER Controller
Route::controller(FooterController::class)->group(function(){
    Route::get('/footer/setup/','footerSetup')->name('footer.setup');
    Route::post('/update/footer', 'UpdateFooter')->name('update.footer');
});
// Contact Me 
Route::controller(ContactMe::class)->group(function(){
    Route::get('/contact/me/','contactMe')->name('contact.me');
    Route::post('/store/message', 'StoreMessage')->name('store.message');
    Route::get('/contact/message', 'ContactMessage')->name('contact.message');   
    Route::get('/delete/message/{id}', 'DeleteMessage')->name('delete.message');   
});

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
