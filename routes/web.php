<?php

use App\Models\Customer;
use App\Models\Consignee;
use App\Models\Consigner;
use Khsingh\India\Entities\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LRMasterController;
use App\Http\Controllers\AddCompanyController;
use App\Http\Controllers\AddExpenseController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\VehicleHireController;
use App\Http\Controllers\DomesticShipmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'home'])->name('pages.home');
Route::get('/login', [AuthController::class, 'userLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login.store');
Route::post('/send-phone-otp', [AuthController::class, 'sendPhoneOtp']);
Route::post('/verify-phone-otp', [AuthController::class, 'verifyPhoneOtp']);
Route::post('/send-email-otp', [AuthController::class, 'sendEmailOtp']);
Route::post('/verify-email-otp', [AuthController::class, 'verifyEmailOtp']);
Route::get('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('user.register.storeppppp');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');


    Route::middleware(['role:super_admin|admin'])->group(function () {
    Route::middleware(['permission:user.create'])->get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::middleware(['permission:user.store'])->post('/user/create', [UserController::class, 'store'])->name('user.store.submit');
    Route::middleware(['permission:user.view'])->get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::middleware(['permission:user.delete'])->delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    
    // Profile Routes
    Route::get('/auth/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/auth/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/auth/change-password', [UserController::class, 'changePassword'])->name('profile.password');
    Route::post('/auth/change-password', [UserController::class, 'updatePassword'])->name('profile.password.update');

});

// Route::middleware(['auth','role:user'])->group(function () {
Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->name('user.dashboard');
// });

/* ================= SUPERADMIN ================= */
Route::middleware('guest')->group(function () {
    Route::get('/superadmin/login', [SuperAdminController::class, 'getmethod'])
        ->name('superadmin.login');

    Route::post('/superadmin/login', [SuperAdminController::class, 'adminLogin'])->name('superadmin.login');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboardpp'])
        ->name('superadmin.dashboard');
});


// Allow either a legacy 'user' role or new 'admin' tenant owner role
Route::middleware(['auth'])->group(function () {

Route::get('/vendor-payment-report', [VehicleHireController::class, 'vendorPaymentReport'])->name('vendor.payment.report');

Route::get(
    '/vendor-payment-report/export',
    [VehicleHireController::class, 'exportVendorPayment']
)->name('vendor.payment.export');


    // View-only routes (require basic authentication)
    Route::middleware(['permission:view shipments'])->get('/domestic-shipment/index', [DomesticShipmentController::class, 'index'])->name('domestic.shipment.index');
    Route::get('/new_pod/{id}', [DomesticShipmentController::class, 'show'])->name('domestic.shipment.pod');

    // Create routes (require create shipments permission)
    Route::middleware(['permission:create shipments'])->group(function () {
        Route::get('/domestic-shipment/create', [DomesticShipmentController::class, 'create'])->name('domestic.shipment.create');
        Route::post('/domestic-shipment/store', [DomesticShipmentController::class, 'store'])->name('domestic.shipment.store');
    });

    // Edit/Update routes (require edit shipments permission)
    Route::middleware(['permission:edit shipments'])->group(function () {
        Route::get('/domestic-shipment/{id}/edit', [DomesticShipmentController::class, 'edit'])->name('domestic.shipment.edit');
        Route::put('/domestic-shipment/{id}', [DomesticShipmentController::class, 'update'])->name('domestic.shipment.update');
    });

    // Delete routes (require delete shipments permission)
    Route::middleware(['permission:delete shipments'])->group(function () {
        Route::delete('/domestic-shipment/{id}', [DomesticShipmentController::class, 'destroy'])->name('domestic.shipment.destroy');
    });

    // Report routes
    // Route::middleware(['permission:view shipments'])->get('/domestic-shipment/report', [DomesticShipmentController::class, 'report'])->name('domestic.shipment.report');

    // Vendor routes with permission checks
    Route::middleware(['permission:create vendors'])->group(function () {
        Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
        Route::post('/vendors/create', [VendorController::class, 'store'])->name('vendors.store');
        Route::get('/vendors/{id}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
        Route::put('/vendors/{id}', [VendorController::class, 'update'])->name('vendors.update');
        Route::delete('/vendors/destroy', [VendorController::class, 'destroy'])->name('vendors.destroy');
    });
    Route::middleware(['permission:view vendors'])->get('/vendors/index', [VendorController::class, 'index'])->name('vendors.index');

    // Branch routes (admin only for now)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('branches', BranchController::class);
    });

    // Customer routes with permission checks
    Route::middleware(['permission:create customers'])->group(function () {
        Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });


    Route::middleware(['permission:vehicle-create'])->group(function () {
        Route::middleware(['permission:view customers'])->get('/customers/index', [CustomerController::class, 'index'])->name('customers.index');
        Route::middleware(['permission:create vehicles'])->group(function () {

            Route::resource('vehicles', VehicleController::class);
        });
        Route::middleware(['permission:view shipments'])->get('/domestic-shipment/index', [DomesticShipmentController::class, 'index'])->name('domestic.shipment.index');
        Route::resource('drivers', DriverController::class);
        Route::resource('add-expenses', AddExpenseController::class);

        Route::middleware(['permission:company-create'])->group(function () {
            Route::resource('company', AddCompanyController::class);
        });

        Route::get('/vehicle_hires/create', [VehicleHireController::class, 'create'])->name('vehicle_hires.create');
        Route::post('/vehicle_hires/store', [VehicleHireController::class, 'store'])->name('vehicle_hires.store');
        Route::get('/vehicle_hires/index', [VehicleHireController::class, 'index'])->name('vehicle_hires.index');
        Route::get('/vehicle_hires/{id}/edit', [VehicleHireController::class, 'edit'])->name('vehicle_hires.edit');
        Route::put('/vehicle_hires/{id}', [VehicleHireController::class, 'update'])->name('vehicle_hires.update');
        Route::delete('/vehicle_hires/{id}', [VehicleHireController::class, 'destroy'])->name('vehicle_hires.destroy');

        Route::post('/domestic/print', [DomesticShipmentController::class, 'print'])
            ->name('domestic.shipment.print');

        Route::get('/domestic/report', [DomesticShipmentController::class, 'report'])
            ->name('domestic.shipment.report');
    });

    Route::middleware(['permission:manage expenses'])->group(function () {
        Route::resource('add-expenses', AddExpenseController::class);
    });

    Route::middleware(['permission:create companies'])->group(function () {
        Route::resource('company', AddCompanyController::class);
    });

    Route::middleware(['permission:manage vehicle hires'])->group(function () {
        Route::get('/vehicle_hires/create', [VehicleHireController::class, 'create'])->name('vehicle_hires.create');
        Route::post('/vehicle_hires/store', [VehicleHireController::class, 'store'])->name('vehicle_hires.store');
        Route::get('/vehicle_hires/index', [VehicleHireController::class, 'index'])->name('vehicle_hires.index');
        Route::get('/vehicle_hires/{id}/edit', [VehicleHireController::class, 'edit'])->name('vehicle_hires.edit');
        Route::put('/vehicle_hires/{id}', [VehicleHireController::class, 'update'])->name('vehicle_hires.update');
        Route::delete('/vehicle_hires/{id}', [VehicleHireController::class, 'destroy'])->name('vehicle_hires.destroy');
    });
});

// Role & Permission management (super admin and tenant owner)
Route::middleware(['auth', 'role:super_admin|admin'])->group(function () {
    Route::get('/roles', [App\Http\Controllers\RolePermissionController::class, 'index'])->name('roles.index');
    Route::post('/roles', [App\Http\Controllers\RolePermissionController::class, 'storeRole'])->name('roles.store');
    Route::post('/permissions', [App\Http\Controllers\RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::post('/roles/assign', [App\Http\Controllers\RolePermissionController::class, 'assignRoleToUser'])->name('roles.assign');
    Route::post('/roles/permission', [App\Http\Controllers\RolePermissionController::class, 'assignPermissionToRole'])->name('roles.permission.assign');
});

// User roles and permissions view (for regular users)
Route::middleware(['auth'])->group(function () {
    Route::get('/my-roles-permissions', [App\Http\Controllers\RolePermissionController::class, 'userRolesPermissions'])->name('user.roles.permissions');
});

// Permission-based route protection examples
Route::middleware(['auth'])->group(function () {
    // Routes that require specific permissions
    Route::middleware(['permission:manage users'])->group(function () {
        // Add user management routes that require 'manage users' permission
        Route::get('/admin/users/advanced', [UserController::class, 'adminIndex'])->name('admin.users.advanced');
    });

    Route::middleware(['permission:view report'])->group(function () {
        Route::get('/domestic/shipments/reports', [DomesticShipmentController::class, 'reports'])
            ->name('domestic.shipment.reports');
    });

    Route::get(
        '/domestic/shipments/reports/export',
        [DomesticShipmentController::class, 'exportExcel']
    )->name('domestic.shipment.reports.export');


    // Route::middleware(['permission:view reports'])->group(function () {
    //     // Add report viewing routes that require 'view reports' permission
    //     Route::get('/reports/summary', [ReportController::class, 'summary'])->name('reports.summary');
    // });

});
// User logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/get-cities/{state}', [DomesticShipmentController::class, 'getCities']);

Route::get('/consignee-details/{id}', function ($id) {
    return response()->json(
        \App\Models\DomesticShipment::findOrFail($id)
    );
});

Route::get('consigner-details/{id}', function ($id) {
    return response()->json(
        \App\Models\DomesticShipment::findOrFail($id)
    );
});

// Superadmin logout
Route::post('/superadmin/logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
Route::post('/user/verify-otp', [AuthController::class, 'verifyOtp'])->name('user.verifyOtp');


Route::get('/get-location/{pincode}', function ($pincode) {
    $data = DB::table('pincodes')->where('pincode', $pincode)->first();

    if (!$data) {
        return response()->json(['error' => 'Invalid pincode'], 404);
    }

    return response()->json([
        'state' => $data->state,
        'city'  => $data->city
    ]);
});



Route::get(
    '/consigner/{id}',
    fn($id) =>
    Consigner::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail()
);

Route::get(
    '/consignee/{id}',
    fn($id) =>
    Consignee::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail()
);
Route::get('/customer/{id}', function ($id) {
    return Customer::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();
});


Route::get('/vendor/{id}', [VehicleHireController::class, 'getVendor'])->name('vendor.details');
Route::get('/vehicle/{id}', [VehicleHireController::class, 'getVehicle'])->name('vehicle.details');
Route::get('/driver/{id}', [VehicleHireController::class, 'getDriver'])->name('driver.details');


