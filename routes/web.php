<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OfferController;

use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductReviewController;

use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Session;
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

Route::get('/',[FrontController::class,'index']);
Route::get('product/{id}',[FrontController::class,'product']); 

Route::get('/contact', [FrontController::class, 'showForm']);
Route::post('/contact', [FrontController::class, 'manageSend'])->name('contact.send');

Route::post('add_to_cart',[FrontController::class,'add_to_cart']);
Route::get('cart',[FrontController::class,'cart']);
Route::get('category/{id}',[FrontController::class,'category']); 
Route::get('search/{str}',[FrontController::class,'search']); 
Route::get('registration',[FrontController::class,'registration']); 
Route::post('registration_process',[FrontController::class,'registration_process'])->name('registration.registration_process');
Route::post('login_process',[FrontController::class,'login_process'])->name('login.login_process');
Route::get('logout', function () {
    Session::forget('FRONT_USER_LOGIN');
    Session::forget('FRONT_USER_ID');
    Session::forget('FRONT_USER_NAME');
    Session::forget('FRONT_TEMP_NAME');
    return redirect('/');
});
Route::get('/verification/{id}',[FrontController::class,'email_verification']);
Route::post('forgot_password',[FrontController::class,'forgot_password']);
Route::get('/forgot_password_change/{id}',[FrontController::class,'forgot_password_change']);
Route::post('forgot_password_change_process',[FrontController::class,'forgot_password_change_process']);
Route::get('/checkout',[FrontController::class,'checkout']);
Route::post('apply_coupon_code',[FrontController::class,'apply_coupon_code']);
Route::post('remove_coupon_code',[FrontController::class,'remove_coupon_code']);
Route::post('place_order',[FrontController::class,'place_order']);
Route::get('/order_placed',[FrontController::class,'order_placed']);
Route::get('/order_fail',[FrontController::class,'order_fail']);

Route::group(['middleware'=>'user_auth'],function () {
    Route::get('/order',[FrontController::class,'order']);
    Route::get('/order_detail/{id}',[FrontController::class,'order_detail']);
    Route::get('/cancel_order/{id}',[FrontController::class,'cancel_order']);
    Route::post('/product_review_process',[FrontController::class,'product_review_process']);
    Route::get('/myaccount',[FrontController::class,'myaccount']);

});
Route::get('/payment_redirect',[FrontController::class,'payment_redirect']);

Route::get('admin/contact', [FrontController::class, 'showdata']);

// ------------------------------------- Admin Route -----------------------------------------------------------


Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');
Route::group(['middleware'=>'admin_auth'],function () {
    Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.index');
    // category Routes Start
        Route::get('admin/category',[CategoryController::class,'index'])->name('index'); 
        Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']); 
        Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage_category']); 
        Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process'); 
        Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']); 
        Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']); 

    // category Routes End
    // Coupons Routes Start
        Route::get('admin/coupon',[CouponController::class,'index'])->name('index'); 
        Route::get('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon']); 
        Route::get('admin/coupon/manage_coupon/{id}',[CouponController::class,'manage_coupon']); 
        Route::post('admin/coupon/manage_coupon_process',[CouponController::class,'manage_coupon_process'])->name('coupon.manage_coupon_process'); 
        Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete']); 
        Route::get('admin/coupon/status/{status}/{id}',[CouponController::class,'status']); 
    // Coupons Routes End
    // Size Routes Start
        Route::get('admin/size',[SizeController::class,'index'])->name('index'); 
        Route::get('admin/size/manage_size',[SizeController::class,'manage_size']); 
        Route::get('admin/size/manage_size/{id}',[SizeController::class,'manage_size']); 
        Route::post('admin/size/manage_size_process',[SizeController::class,'manage_size_process'])->name('size.manage_size_process'); 
        Route::get('admin/size/delete/{id}',[SizeController::class,'delete']); 
        Route::get('admin/size/status/{status}/{id}',[SizeController::class,'status']); 
    // Size Routes End
    // Color Routes Start
        Route::get('admin/color',[ColorController::class,'index'])->name('index'); 
        Route::get('admin/color/manage_color',[ColorController::class,'manage_color']); 
        Route::get('admin/color/manage_color/{id}',[ColorController::class,'manage_color']); 
        Route::post('admin/color/manage_color_process',[ColorController::class,'manage_color_process'])->name('color.manage_color_process'); 
        Route::get('admin/color/delete/{id}',[ColorController::class,'delete']); 
        Route::get('admin/color/status/{status}/{id}',[ColorController::class,'status']); 
   // Color Routes End
   // product Routes Start
            Route::get('admin/product',[ProductController::class,'index'])->name('index'); 
            Route::get('admin/product/manage_product',[ProductController::class,'manage_product']); 
            Route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']); 
            Route::post('admin/product/manage_product_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process'); 
            Route::get('admin/product/delete/{id}',[ProductController::class,'delete']); 

            Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);

            Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);
            
            Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']); 
   //Product Routes End
    // Brands Routes Start
     Route::get('admin/brand',[BrandController::class,'index'])->name('index'); 
     Route::get('admin/brand/manage_brand',[BrandController::class,'manage_brand']); 
     Route::get('admin/brand/manage_brand/{id}',[BrandController::class,'manage_brand']); 
     Route::post('admin/brand/manage_brand_process',[BrandController::class,'manage_brand_process'])->name('brand.manage_brand_process'); 
     Route::get('admin/brand/delete/{id}',[BrandController::class,'delete']); 
     Route::get('admin/brand/status/{status}/{id}',[BrandController::class,'status']); 
   // Brands Routes End
   // Tax Routes Start
        Route::get('admin/tax',[TaxController::class,'index'])->name('index'); 
        Route::get('admin/tax/manage_tax',[TaxController::class,'manage_tax']); 
        Route::get('admin/tax/manage_tax/{id}',[TaxController::class,'manage_tax']); 
        Route::post('admin/tax/manage_tax_process',[TaxController::class,'manage_tax_process'])->name('tax.manage_tax_process'); 
        Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']); 
        Route::get('admin/tax/status/{status}/{id}',[TaxController::class,'status']); 
   // Tax Routes End
  // Banners Routes Start
    Route::get('admin/home_banner',[HomeBannerController::class,'index'])->name('index'); 
    Route::get('admin/home_banner/manage_home_banner',[HomeBannerController::class,'manage_home_banner']); 
    Route::get('admin/home_banner/manage_home_banner/{id}',[HomeBannerController::class,'manage_home_banner']); 
    Route::post('admin/home_banner/manage_home_banner_process',[HomeBannerController::class,'manage_home_banner_process'])->name('home_banner.manage_home_banner_process'); 
    Route::get('admin/home_banner/delete/{id}',[HomeBannerController::class,'delete']); 
    Route::get('admin/home_banner/status/{status}/{id}',[HomeBannerController::class,'status']); 
  // Banners Routes End

   // Customers Routes Start
    Route::get('admin/customer',[CustomerController::class,'index'])->name('index'); 
    Route::get('admin/customer/show/{id}',[CustomerController::class,'show']); 
    Route::get('admin/customer/status/{status}/{id}',[CustomerController::class,'status']); 
  // Customers Routes End

    //order routes Start
       Route::get('admin/order',[OrderController::class,'index'])->name('index'); 
       Route::get('admin/order/order_detail/{id}',[OrderController::class,'order_detail']); 
       Route::get('admin/order/update_payment_status/{status}/{id}',[OrderController::class,'update_payment_status']); 
       Route::get('admin/order/update_order_status/{status}/{id}',[OrderController::class,'update_order_status']); 
       Route::get('admin/order/update_order_status/{status}/{id}',[OrderController::class,'update_order_status']); 
       Route::post('admin/order/order_detail/{id}',[OrderController::class,'update_track_detail']);
       Route::get('admin/order/BillGenerate/{id}',[OrderController::class,'BillGenerate']);

    //order routes End
     // Special Offer Routes Start
        Route::get('admin/offers',[OfferController::class,'index'])->name('index'); 
        Route::get('admin/offers/manage_offer',[OfferController::class,'manage_offer']);
        Route::get('admin/offers/manage_offer/{id}',[OfferController::class,'manage_offer']); 

        Route::post('admin/offers/manage_offer_process',[OfferController::class,'manage_offer_process'])->name('offers.manage_offer_process'); 
        
        Route::get('admin/offers/delete/{id}',[OfferController::class,'delete']); 
        Route::get('admin/offers/status/{status}/{id}',[OfferController::class,'status']); 

        Route::get('admin/offers/send/{id}',[OfferController::class,'send']);

   // Special Offer Routes End

    //Product Review routes Start
        Route::get('admin/product_review',[ProductReviewController::class,'index'])->name('index'); 
        Route::get('admin/product_review/update_product_review_status/{status}/{id}',[ProductReviewController::class,'update_product_review_status']); 
   //Product Review routes End

    // Customers Routes Start
     Route::get('admin/dashboard',[DashboardController::class,'index'])->name('index'); 
    // Customers Routes End

    Route::get('admin/logout', function () {
        Session::forget('ADMIN_LOGIN');
        Session::forget('ADMIN_ID');
        return redirect('admin')->with('error','Logout Sucessfully');
    });
    

    
});


