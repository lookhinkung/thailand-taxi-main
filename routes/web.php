<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\CarTypeController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Frontend\FrontendCarController;
use App\Http\Controllers\Frontend\BookingController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/password/change/password', [UserController::class, 'UserChangePasswordStore'])->name('password.change.store');

});

require __DIR__ . '/auth.php';
// Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

});//End of Group Middleware

// Book Area Route



Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


// Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

    /// Team Route
    Route::controller(TeamController::class)->group(function () {

        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');

    });


//Admin Booking All Route
Route::controller(BookingController::class)->group(function () {

    Route::get('/booking/list','BookingList')->name('booking.list'); 
    Route::get('/edit/booking/{id}','EditBooking')->name('edit_booking'); 

});



});//End of Group Middleware


// Book Area All Route
Route::controller(TeamController::class)->group(function () {

    Route::get('/book/area','BookArea')->name('book.area');
    Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');

});

// RoomType All Route
Route::controller(CarTypeController::class)->group(function () {

    Route::get('/car/type/list','CarTypeList')->name('car.type.list'); 
    Route::get('/add/car/type','AddCarType')->name('add.car.type');
    Route::post('/car/type/store','CarTypeStore')->name('car.type.store');
    Route::get('/edit/car/{id}','EditCar')->name('edit.car'); 
    
});

// Room All Route
Route::controller(CarController::class)->group(function () {

    Route::get('/edit/car/{id}','EditCar')->name('edit.car'); 
    Route::post('/update/car/{id}','UpdateCar')->name('update.car'); 
    Route::get('/multi/image/delete/{id}','MultiImageDelete')->name('multi.image.delete');

    Route::post('/store/car/no/{id}','StoreCarNumber')->name('store.car.no'); 
    Route::get('/edit/carno/{id}','EditCarNumber')->name('edit.carno'); 
    Route::post('/update/carno/{id}','UpdateCarNumber')->name('update.carno'); 
    Route::get('/delete/carno/{id}','DeleteCarNumber')->name('delete.carno');

    Route::get('/delete/car/{id}','DeleteCar')->name('delete.car');
    
  
});


Route::controller(FrontendCarController::class)->group(function () {

    Route::get('/cars','AllFrontendCarList')->name('fcar.all'); 
    Route::get('/cars/details/{id}','CarDetailsPage'); 
    Route::get('/aboutus','AboutUs')->name('about.us'); 
    Route::get('/bookings','BookingSearch')->name('booking.search'); 
    Route::get('/search/car/details/{id}','SearchCarDetails')->name('search_car_details');

    Route::get('/check_car_availability','CheckCarAvailability')->name('check_car_availability');
    
  
});


//Auth middleware user must have login for access this route
Route::middleware(['auth'])->group(function () {

    Route::controller(BookingController::class)->group(function () {

        //Checkout all route
        Route::get('/checkout/','Checkout')->name('checkout'); 
        Route::post('/booking/store/','BookingStore')->name('user_booking_store'); 
        Route::post('/checkout/store/','CheckoutStore')->name('checkout.store');
        
        
      
    });

});//End group Auh Middleware