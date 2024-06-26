<?php

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\CarTypeController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Frontend\FrontendCarController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\CarListController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RoleController;




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

        Route::get('/all/team', 'AllTeam')->name('all.team')->middleware('permission:team.menu');
        Route::get('/add/team', 'AddTeam')->name('add.team')->middleware('permission:team.add');
        Route::post('/team/store', 'StoreTeam')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team')->middleware('permission:team.edit');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team')->middleware('permission:team.delete');

    });


    //Admin Booking All Route
    Route::controller(BookingController::class)->group(function () {

        Route::get('/booking/list', 'BookingList')->name('booking.list');
        Route::get('/edit_booking/{id}', 'EditBooking')->name('edit_booking');
        Route::get('/delete/booking/{id}', 'DeleteBooking')->name('delete.booking');
        Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');

    });

    //Admin Car List All Route
    Route::controller(CarListController::class)->group(function () {

        Route::get('view/car/list', 'ViewCarList')->name('view.car.list');
        Route::get('add/car/list', 'AddCarList')->name('add.car.list');
        Route::post('store/car/list', 'StoreCarList')->name('store.car.list');

    });

    //Testimonial All Route
    Route::controller(TestimonialController::class)->group(function () {

        Route::get('all/testimonial', 'AllTestimonial')->name('all.testimonial');
        Route::get('add/testimonial', 'AddTestimonial')->name('add.testimonial');
        Route::post('store/testimonial', 'StoreTestimonial')->name('testimonial.store');
        Route::get('edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
        Route::post('update/testimonial', 'UpdateTestimonial')->name('testimonial.update');
        Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');

    });

    //Blog Category All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('blog/category', 'BlogCategory')->name('blog.category');
        Route::post('store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('edit/blog/category/{id}', 'EditBlogCategory');
        Route::post('update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');

    });

    //Blog Post All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('all/blog/post', 'AllBlogPost')->name('all.blog.post');
        Route::get('add/blog/post', 'AddBlogPost')->name('add.blog.post');
        Route::post('store/blog/post', 'StoreBlogPost')->name('store.blog.post');
        Route::get('edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
        Route::post('update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
        Route::get('delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');


        //////////// Frontend //////////////////////

    });

    //Admin Car List All Route
    Route::controller(SettingController::class)->group(function () {

        Route::get('smtp/setting', 'SmtpSetting')->name('smtp.setting');
        Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');


    });

    Route::controller(CommentController::class)->group(function () {

        Route::get('all/comment/', 'AllComment')->name('all.comment');
        Route::post('update/comment/status', 'UpdateCommentStatus')->name('update.comment.status');

    });


    Route::controller(CommentController::class)->group(function () {

        Route::get('all/comment/', 'AllComment')->name('all.comment');
        Route::post('update/comment/status', 'UpdateCommentStatus')->name('update.comment.status');

    });

    /// Booking Report All Route
    Route::controller(ReportController::class)->group(function () {

        Route::get('booking/report/', 'BookingReport')->name('booking.report');
        Route::post('search-by-date', 'SearchByDate')->name('search-by-date');


    });

    // Site Setting All Route
    Route::controller(SettingController::class)->group(function () {

        Route::get('site/setting', 'SiteSetting')->name('site.setting');
        Route::post('site/update', 'SiteUpdate')->name('site.update');


    });


    // Permission All Route
    Route::controller(RoleController::class)->group(function () {

        Route::get('all/permission', 'AllPermission')->name('all.permission');
        Route::get('add/permission', 'AddPermission')->name('add.permission');

        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('delete/permission/{id}', 'DeletePermission')->name('delete.permission');


        Route::get('import/permission', 'ImportPermission')->name('import.permission');


    });

    // Role All Route
    Route::controller(RoleController::class)->group(function () {

        Route::get('all/roles', 'AllRoles')->name('all.roles');
        Route::get('add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('delete/roles/{id}', 'DeleteRoles')->name('delete.roles');

        Route::get('add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('all/roles/permission', 'AllRolePermission')->name('all.roles.permission');

        Route::get('admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
    });

    //Admin User All Route
    Route::controller(AdminController::class)->group(function () {

        Route::get('all/admin', 'AllAdmin')->name('all.admin');
        Route::get('add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');

    });

});//End Admin Group Middleware


// Book Area All Route
Route::controller(TeamController::class)->group(function () {

    Route::get('/book/area', 'BookArea')->name('book.area');
    Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');

});

// CarType All Route
Route::controller(CarTypeController::class)->group(function () {

    Route::get('/car/type/list', 'CarTypeList')->name('car.type.list');
    Route::get('/add/car/type', 'AddCarType')->name('add.car.type');
    Route::post('/car/type/store', 'CarTypeStore')->name('car.type.store');
    Route::get('/edit/car/{id}', 'EditCar')->name('edit.car');

});

// Car All Route
Route::controller(CarController::class)->group(function () {

    Route::get('/edit/car/{id}', 'EditCar')->name('edit.car');
    Route::post('/update/car/{id}', 'UpdateCar')->name('update.car');
    Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');
    Route::get('/edit/carno/{id}', 'EditCarNumber2')->name('edit.carno2');
    Route::post('/store/car/no/{id}', 'StoreCarNumber')->name('store.car.no');
    Route::get('/edit/carno/{id}', 'EditCarNumber')->name('edit.carno');
    Route::post('/update/carno/{id}', 'UpdateCarNumber')->name('update.carno');
    Route::get('/delete/carno/{id}', 'DeleteCarNumber')->name('delete.carno');

    Route::get('/delete/car/{id}', 'DeleteCar')->name('delete.car');


});


Route::controller(FrontendCarController::class)->group(function () {

    Route::get('/cars', 'AllFrontendCarList')->name('fcar.all');
    Route::get('/cars/details/{id}', 'CarDetailsPage');
    Route::get('/aboutus', 'AboutUs')->name('about.us');
    Route::get('/bookings', 'BookingSearch')->name('booking.search');
    Route::get('/search/car/details/{id}', 'SearchCarDetails')->name('search_car_details');

    Route::get('/check_car_availability', 'CheckCarAvailability')->name('check_car_availability');


});


//Auth middleware user must have login for access this route
Route::middleware(['auth'])->group(function () {

    Route::controller(BookingController::class)->group(function () {

        //Checkout all route
        Route::get('/checkout/', 'Checkout')->name('checkout');
        Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
        Route::post('/checkout/store/', 'CheckoutStore')->name('checkout.store');

        // booking Update
        Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
        Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');

        // Assign Car route
        Route::get('/assign_car/{id}', 'AssignCar')->name('assign_car');
        Route::get('/assign_car/store/{booking_id}/{car_number_id}', 'AssignCarStore')->name('assign_car_store');
        Route::get('/assign_car/delete/{id}', 'AssignCarDelete')->name('assign_car_delete');

        /////////// User Booking Route
        Route::get('/user/booking', 'UserBooking')->name('user.booking');
        Route::get('/user/invoice/{id}', 'UserInvoice')->name('user.invoice');


    });

});//End group Auth Middleware


//Frontend Blog All route
Route::controller(BlogController::class)->group(function () {

    Route::get('blog/details/{slug}', 'BlogDetails');
    Route::get('blog/cat/list/{id}', 'BlogCatList');
    Route::get('/blog', 'BlogList')->name('blog.list');

});

//Frontend Comment All route
Route::controller(CommentController::class)->group(function () {

    Route::post('store/comment/', 'StoreComment')->name('store.comment');

    // Contact All Route
    Route::get('/contact', 'ContactUs')->name('contact.us');
    Route::post('store/contact', 'StoreContact')->name('store.contact');

    // Contact Message Admin
    Route::get('/contact/message', 'AdminContactMessage')->name('contact.message');
});



Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);



// Notification All route
Route::controller(BookingController::class)->group(function () {

    Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
});