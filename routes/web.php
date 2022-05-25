<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TruckController; 
use App\Http\Controllers\BookingController; 
use App\Http\Controllers\PusherController; 
use App\Http\Controllers\Cron_Controller; 
Route::group(['middleware' => 'guest'], function () {
	Route::get('/login',[LoginController::class,'View_Login'])->name('login_view');
	Route::post('/login',[LoginController::class,'login'])->name('login');

	Route::get('/forgot-password',[LoginController::class,'forgot'])->name('forgot');
	Route::post('/forgot-password',[LoginController::class,'get_password'])->name('forgot-password');

	Route::get('/reset-password/{id}',[LoginController::class,'reset_view'])->name('reset-password-view');
	Route::post('/reset-password',[LoginController::class,'update_password'])->name('reset-password');

});
Route::group(['middleware'=>'masterAdmin'],function(){
	Route::get('/',[MasterAdminController::class,'index'])->name('master_admin_dashboard');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


Route::group(['middleware'=>'admin'],function(){
	
	// Load Curd
	Route::get('/add/load',[LoadController::class,'add'])->name('load-add');
	Route::post('/add/load',[LoadController::class,'save'])->name('load_add_post');
	Route::get('/view/load',[LoadController::class,'view'])->name('load-view');
	Route::get('/view/cancel',[LoadController::class,'view_cancel'])->name('cancel-view');
	Route::get('/update/load/{id}',[LoadController::class,'get'])->name('load_update');
	Route::get('/delete/load/{id}',[LoadController::class,'delete'])->name('load_delete');
	Route::post('/update/load/{id}',[LoadController::class,'update'])->name('load_update_post');
	Route::post('/cancel/load/',[LoadController::class,'cancel'])->name('load_cancel_post');


	// truck curd

	Route::get('/add/truck/{id}',[TruckController::class,'index'])->name('add-truck');
	Route::post('/add/truck/{id}',[TruckController::class,'save'])->name('truck_add_post');
	Route::get('/view/truck/{id}',[TruckController::class,'show'])->name('view-truck');
	Route::get('/update/truck/{id}',[TruckController::class,'get'])->name('truck_update');

	Route::get('/delete/truck/{id}',[TruckController::class,'delete'])->name('truck_delete');
	Route::post('/update/truck/{id}',[TruckController::class,'update'])->name('truck_update_post');

	Route::get('/search/truck/',[TruckController::class,'search'])->name('search_truck');
	Route::get('/reset/truck/{id}',[TruckController::class,'reset_password'])->name('reset_password');
	Route::post('/search/truck/',[TruckController::class,'search_truck'])->name('search');

	// transport Curd

	Route::get('/add/transport',[TransportController::class,'add'])->name('transport_add');
	Route::post('/add/transport',[TransportController::class,'save'])->name('transport_add_post');
	Route::get('/view/transport',[TransportController::class,'show'])->name('transport_view');
	Route::get('/update/transport/{id}',[TransportController::class,'get'])->name('transport_update');
	Route::get('/delete/transport/{id}',[TransportController::class,'delete'])->name('transport_delete');
	Route::post('/update/transport/{id}',[TransportController::class,'update'])->name('transport_update_post');


	// Booking
	Route::get('/add/booking',[BookingController::class,'add'])->name('booking');
	Route::post('/save/booking',[BookingController::class,'save'])->name('save_booking');
	Route::get('/view/booking',[BookingController::class,'show'])->name('view-booking');
	Route::get('/view/cancel/booking',[BookingController::class,'show_cancel'])->name('view-booking-cancel');
	Route::post('/cancel/booking',[BookingController::class,'cancel'])->name('cancel-booking');

});
Route::get('/cron/sendNotification',[Cron_Controller::class,'send']);
Route::group(['middleware'=>'masterAdmin'],function(){
		// Branch Curd

		Route::get('/add/branch',[BranchController::class,'index'])->name('branch_add');
		Route::post('/add/branch',[BranchController::class,'save'])->name('branch_add_post');
		Route::get('/view/branch',[BranchController::class,'show'])->name('branch_view');
		Route::get('/update/branch/{id}',[BranchController::class,'get'])->name('branch_update');
		Route::get('/delete/branch/{id}',[BranchController::class,'delete'])->name('branch_delete');
		Route::post('/update/branch/{id}',[BranchController::class,'update'])->name('branch_update_post');
	
});

// Ajax
Route::post('/ajax/district',[DistrictController::class,'get'])->name('district');
Route::post('/ajax/pusher',[PusherController::class,'save'])->name('save_push_id');

//  Admin
Route::group(['middleware'=>'admin'],function(){
	Route::get('/admin-dashboard',[AdminController::class,'index'])->name('admin-dashboard');
	// Load Curd
	// Route::get('/add/load',[LoadController::class,'add'])->name('load-add');
	// Route::post('/add/load',[LoadController::class,'save'])->name('load_add_post');
	// Route::get('/view/load',[LoadController::class,'view'])->name('load-view');
	// Route::get('/update/load/{id}',[LoadController::class,'get'])->name('load_update');
	// Route::get('/delete/load/{id}',[LoadController::class,'delete'])->name('load_delete');
	// Route::post('/update/load/{id}',[LoadController::class,'update'])->name('load_update_post');

	 
	// // truck curd

	// Route::get('/add/truck/{id}',[TruckController::class,'index'])->name('add-truck');
	// Route::post('/add/truck/{id}',[TruckController::class,'save'])->name('truck_add_post');
	// Route::get('/view/truck/{id}',[TruckController::class,'show'])->name('view-truck');
	// Route::get('/update/truck/{id}',[TruckController::class,'get'])->name('truck_update');

	// Route::get('/delete/truck/{id}',[TruckController::class,'delete'])->name('truck_delete');
	// Route::post('/update/truck/{id}',[TruckController::class,'update'])->name('truck_update_post');


	// // transport Curd

	// Route::get('/add/transport',[TransportController::class,'add'])->name('transport_add');
	// Route::post('/add/transport',[TransportController::class,'save'])->name('transport_add_post');
	// Route::get('/view/transport',[TransportController::class,'show'])->name('transport_view');
	// Route::get('/update/transport/{id}',[TransportController::class,'get'])->name('transport_update');
	// Route::get('/delete/transport/{id}',[TransportController::class,'delete'])->name('transport_delete');
	// Route::post('/update/transport/{id}',[TransportController::class,'update'])->name('transport_update_post');


	
});

//  Driver
Route::group(['middleware'=>'driver'],function(){
	Route::get('/driver-dashboard',[DriverController::class,'index'])->name('driver-dashboard');
});

//  Transport
Route::group(['middleware'=>'transport'],function(){
	Route::get('/transport-dashboard',[TransportController::class,'index'])->name('transport-dashboard');
	Route::get('/my-trucks',[TransportController::class,'my_truck'])->name('my_trucks');
	// Route::get('/update/truck/{id}',[TruckController::class,'get'])->name('transport_truck_update');

	// Route::get('/delete/truck/{id}',[TruckController::class,'delete'])->name('truck_delete');
	// Route::post('/update/truck/{id}',[TruckController::class,'update'])->name('transport_truck_update_post');

});


Route::group(['middleware'=>'truck'],function(){
	Route::get('/truck-dashboard',[TruckController::class,'dashboard'])->name('truck-dashboard');
	Route::post('/update_truck_location',[TruckController::class,'update_truck_location'])->name('update_truck_location');
});
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/home',[LoginController::class,'home'])->name('home');