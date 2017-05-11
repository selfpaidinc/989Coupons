<?php

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

Route::any('/', 'CouponController@lander')->name('lander');
Route::any('/unsubscribe', 'CouponController@unsubscribe')->name('unsubscribe');
Route::any('/advertise', 'CouponController@advertise')->name('advertise');
Route::any('/contact', 'CouponController@contact')->name('contact');
Route::get('/coupon/{id}', 'CouponController@coupon')->name('coupon');

Route::get('/admin/staff', 'AdminController@staff')->name('staff')->middleware('admin');
Route::get('/admin/staff/delete/{id}', 'AdminController@staffDelete')->name('staff_delete')->middleware('admin');
Route::any('/admin/staff/create', 'AdminController@staffCreate')->name('staff_create')->middleware('admin');
Route::any('/admin/staff/edit/{id}', 'AdminController@staffEdit')->name('staff_edit')->middleware('admin');

Route::get('/admin/subscribers', 'AdminController@subscribers')->name('subscribers')->middleware('admin');
Route::any('/admin/subscribers/create', 'AdminController@subscribersCreate')->name('subscribers_create')->middleware('admin');
Route::any('/admin/subscribers/edit/{id}', 'AdminController@subscribersEdit')->name('subscribers_edit')->middleware('admin');

Route::get('/staff/coupons', 'StaffController@coupons')->name('coupons');
Route::any('/staff/coupons/delete/{id}', 'StaffController@couponsDelete')->name('coupons_edit');
Route::any('/staff/coupons/create', 'StaffController@couponsCreate')->name('coupons_create');
Route::any('/staff/coupons/edit/{id}', 'StaffController@couponsEdit')->name('coupons_edit');

Route::get('/staff/ads', 'StaffController@ads')->name('ads');
Route::any('/staff/ads/delete/{id}', 'StaffController@adsDelete')->name('ads_edit');
Route::any('/staff/ads/create', 'StaffController@adsCreate')->name('ads_create');
Route::any('/staff/ads/edit/{id}', 'StaffController@adsEdit')->name('ads_edit');

Route::get('/staff/emails/preview/{id}', 'StaffController@emailsPreview')->name('emails_preview');

Route::post('/staff/ads/upload', 'CropController@postUpload');
Route::post('/staff/ads/crop', 'CropController@postCrop');

Route::get('/staff/emails', 'StaffController@emails')->name('emails');
Route::any('/staff/emails/edit/{id}', 'StaffController@emailsEdit')->name('emails');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'TestController@test')->name('test');