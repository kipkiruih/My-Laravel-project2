<?php
use App\Http\Controllers\Owner\OwnerDashboardController;
use App\Http\Controllers\Tenant\TenantDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\OwnerPropertyController;
use App\Http\Controllers\Owner\OwnerRentalApplicationController;
use App\Http\Controllers\Tenant\TenantRentalApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Tenant\BookmarkController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Tenant\RatingController;
use App\Http\Controllers\Tenant\FavoriteController;
use App\Http\Controllers\Tenant\ReviewController;
use App\Http\Controllers\Owner\ReviewReplyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MpesaController;

Auth::routes();




/*Route::get('/', function () {
  return view('home');
});*/
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

//Route::get('/', [PropertyController::class, 'home']);

Route::get('/blog', [BlogController::class, 'index'])->name('home');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog', [BlogController::class, 'blogIndex'])->name('blog.index');

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');




//Route::middleware(['auth', 'log.property.activity'])->group(function () {
   //Route::resource('properties', PropertyController::class);
//});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    //Route::get('/tenant/payments', [PaymentController::class, 'paymentHistory'])->name('tenant.payments.history');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

});


Route::middleware(['auth'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index'); // Changed from history
    Route::get('/payments/pay', [MpesaController::class, 'pay'])->name('payments.pay_rent');
   // Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');
    //Route::post('/payments/initiate', [PaymentController::class, 'initiatePayment'])->name('payments.initiate');

    Route::get('/payments/invoice/{id}', [PaymentController::class, 'generateInvoice'])->name('payments.invoice');

    Route::post('/mpesa/callback', [PaymentController::class, 'mpesaCallback']);

    Route::post('/mpesa/pay', [MpesaController::class, 'stkPush'])->name('mpesa.pay');
    Route::post('/mpesa/pay', [MpesaController::class, 'initiatePayment']);
    Route::post('/mpesa/callback', [MpesaController::class, 'mpesaCallback']);
});




Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::post('/users/{id}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
    Route::post('/users/{id}/suspend', [UserController::class, 'suspend'])->name('admin.users.suspend');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Properties
    Route::get('/properties', [\App\Http\Controllers\Admin\PropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('/properties/{id}/edit', [\App\Http\Controllers\Admin\PropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::put('/properties/{id}', [\App\Http\Controllers\Admin\PropertyController::class, 'update'])->name('admin.properties.update');
    Route::post('/properties/{id}/approve', [\App\Http\Controllers\Admin\PropertyController::class, 'approve'])->name('admin.properties.approve');
    Route::post('/properties/{id}/reject', [\App\Http\Controllers\Admin\PropertyController::class, 'reject'])->name('admin.properties.reject');
    Route::delete('/properties/{id}', [\App\Http\Controllers\Admin\PropertyController::class, 'destroy'])->name('admin.properties.destroy');

    // Rental Applications
    Route::get('/rental-applications', [\App\Http\Controllers\Admin\RentalApplicationController::class, 'index'])->name('admin.rental-applications.index');
    Route::get('/rental-applications/{id}', [\App\Http\Controllers\Admin\RentalApplicationController::class, 'show'])->name('admin.rental-applications.show');
    Route::post('/rental-applications/{id}/resolve', [\App\Http\Controllers\Admin\RentalApplicationController::class, 'resolveDispute'])->name('admin.rental-applications.resolve');

    // Reviews
    Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::get('/reviews/{id}', [\App\Http\Controllers\Admin\ReviewController::class, 'show'])->name('admin.reviews.show');
    Route::delete('/reviews/{id}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    //Activities
    
   // Route::get('/activities', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('admin.activities.index');


    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
    Route::get('/site-settings', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'index'])->name('admin.site-settings');
    Route::post('/site-settings', [\App\Http\Controllers\Admin\SiteSettingsController::class, 'update']);

    Route::get('/security-settings', [\App\Http\Controllers\Admin\SecuritySettingsController::class, 'index'])->name('security-settings.index');
    Route::post('/security-settings', [\App\Http\Controllers\Admin\SecuritySettingsController::class, 'update'])->name('security-settings.update');

});








Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('rental_applications', OwnerRentalApplicationController::class)
        ->only(['index', 'show', 'update']);

    Route::resource('properties', OwnerPropertyController::class);
    Route::resource('maintenance', \App\Http\Controllers\Owner\MaintenanceRequestController::class);

    Route::get('tenants', [\App\Http\Controllers\Owner\TenantController::class, 'index'])->name('tenants.index');
    Route::get('tenants/{tenant}', [\App\Http\Controllers\Owner\TenantController::class, 'show'])->name('tenants.show');
    Route::delete('tenants/{tenant}', [\App\Http\Controllers\Owner\TenantController::class, 'destroy'])->name('tenants.destroy');

   
   // Route::get('/owner/tenants/create', [\App\Http\Controllers\Owner\TenantController::class, 'create'])->name('tenants.create');
    Route::get('/owner/tenants/add', [\App\Http\Controllers\Owner\TenantController::class, 'create'])->name('tenants.add');


Route::post('/tenants', [\App\Http\Controllers\Owner\TenantController::class, 'store'])->name('tenants.store');
Route::get('/tenants/{id}/edit', [\App\Http\Controllers\Owner\TenantController::class, 'edit'])->name('tenants.edit');
Route::put('/tenants/{id}', [\App\Http\Controllers\Owner\TenantController::class, 'update'])->name('tenants.update');

Route::get('/owner/payments', [OwnerDashboardController::class, 'payments'])->name('payments');

Route::get('/owner/payments/invoice/{id}', [OwnerDashboardController::class, 'downloadInvoice'])
    ->name('downloadInvoice');

});
Route::middleware(['auth', 'role:tenant'])
    ->prefix('tenant') // Adds "tenant/" before the route URL
    ->name('tenant.')  // Adds "tenant." before route names
    ->group(function () {
        Route::get('/dashboard', [TenantDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/rental_applications', TenantRentalApplicationController::class);
    
        Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
        Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
        Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
    
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
        Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    
        Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

        Route::resource('maintenance', \App\Http\Controllers\Tenant\MaintenanceRequestController::class);
        
    });


     //   Route::resource('tenant/maintenance', MaintenanceRequestController::class);
    //});
    



Route::get('/notifications/read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->find($id);
    if ($notification) {
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }
    return redirect()->back();
})->name('notifications.read');


Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('tenant.reviews.store');
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('tenant.reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('tenant.reviews.destroy');

    Route::post('/review-replies', [ReviewReplyController::class, 'store'])->name('owner.review-replies.store');
});
