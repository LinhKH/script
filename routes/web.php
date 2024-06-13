<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Yb_AdminController;
use App\Http\Controllers\Yb_CategoryController;
use App\Http\Controllers\Yb_PlanController;
use App\Http\Controllers\Yb_BlogCategoryController;
use App\Http\Controllers\Yb_BlogController;
use App\Http\Controllers\Yb_BookingController;
use App\Http\Controllers\Yb_ReviewRatingController;
use App\Http\Controllers\Yb_UserController;
use App\Http\Controllers\Yb_PageController;
use App\Http\Controllers\Yb_SettingController;
use App\Http\Controllers\Yb_SocialSettingController;
use App\Http\Controllers\Yb_HomeController;
use App\Http\Controllers\Yb_PaymentController;
use App\Http\Controllers\Yb_LocationController;
use App\Http\Controllers\Yb_CommentsController;


Route::group(['middleware' => 'protectedPage'], function () {
    Route::any('/admin', [Yb_AdminController::class, 'yb_index']);
    Route::get('admin/logout', [Yb_AdminController::class, 'yb_logout']);
    Route::get('admin/dashboard', [Yb_AdminController::class, 'yb_dashboard']);
    Route::resource('admin/categories', Yb_CategoryController::class);
    Route::resource('admin/plans', Yb_PlanController::class);
    Route::resource('admin/blogs', Yb_BlogController::class);
    Route::resource('admin/b-category', Yb_BlogCategoryController::class);
    Route::resource('admin/booking', Yb_BookingController::class);
    Route::resource('admin/location', Yb_LocationController::class);
    Route::resource('admin/rating', Yb_ReviewRatingController::class);
    Route::resource('admin/users', Yb_UserController::class);
    Route::resource('admin/pages', Yb_PageController::class);
    Route::resource('admin/comment', Yb_CommentsController::class);
    Route::post('admin/page_showIn_header', [Yb_PageController::class, 'yb_show_in_header']);
    Route::post('admin/page_showIn_footer', [Yb_PageController::class, 'yb_show_in_footer']);
    Route::resource('admin/social-settings', Yb_SocialSettingController::class);

    Route::any('admin/general-settings', [Yb_SettingController::class, 'yb_general_settings']);
    Route::any('admin/profile-settings', [Yb_SettingController::class, 'yb_profile_settings']);
    Route::any('admin/banner-settings', [Yb_SettingController::class, 'yb_banner_settings']);
    Route::post('admin/change-password', [Yb_SettingController::class, 'yb_change_password']);
    Route::post('admin/get-locations', [Yb_PlanController::class, 'get_location_by_category']);
    Route::post('admin/get-locations_edit', [Yb_PlanController::class, 'get_location_by_category_edit']);
});


Route::get('/', [Yb_HomeController::class, 'index']);
Route::get('/plans', [Yb_HomeController::class, 'yb_category']);
Route::get('contact', [Yb_HomeController::class, 'yb_contact']);
Route::post('contact', [Yb_HomeController::class, 'yb_contactStore']);
Route::get('/plans/{slug}/checkout', [Yb_UserController::class, 'yb_checkout']);
// Route::get('/plans/{slug}/checkout/confirm', [Yb_UserController::class, 'store']);
Route::post('/plans/{slug}/checkout', [Yb_UserController::class, 'payWithStripe']);

Route::get('stripe/success', [Yb_UserController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('stripe/cancel', [Yb_UserController::class, 'stripeCancel'])->name('stripe.cancel');

Route::get('/success', [yb_BookingController::class, 'success']);
Route::get('/payment/failed', [yb_BookingController::class, 'failedPayment']);
Route::get('/my_booking', [Yb_UserController::class, 'yb_booking']);

Route::get('blogs', [Yb_HomeController::class, 'yb_blogs']);
Route::get('blogs/c/{slug}', [Yb_HomeController::class, 'yb_blogs_categories']);
Route::get('blogs/{slug}/{text}', [Yb_HomeController::class, 'yb_blogSinglePage']);

Route::any('/login', [Yb_UserController::class, 'yb_login']);
Route::any('signup', [Yb_UserController::class, 'yb_signup']);
Route::get('profile', [Yb_UserController::class, 'yb_profile']);
Route::post('profile', [Yb_UserController::class, 'yb_profileUpdate']);
Route::post('user/change-image', [Yb_UserController::class, 'update_image']);
Route::any('logout', [Yb_UserController::class, 'yb_logout']);

Route::any('change-password', [Yb_UserController::class, 'yb_change_password']);
Route::any('forgot-password', [Yb_UserController::class, 'yb_forgot_password']);
Route::post('update-password', [Yb_UserController::class, 'yb_reset_passwordUpdate']);
Route::get('reset-password', [Yb_UserController::class, 'yb_reset_password']);

Route::post('comment-store', [Yb_CommentsController::class, 'store']);
Route::post('review', [Yb_ReviewRatingController::class, 'store']);

Route::get('{text}/{slug}', [Yb_HomeController::class, 'yb_singlePage']);
Route::get('/{page}', [Yb_HomeController::class, 'yb_footer_pages']);
