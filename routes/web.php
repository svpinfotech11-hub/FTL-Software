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
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LRMasterController;
use App\Http\Controllers\AddCompanyController;
use App\Http\Controllers\AddExpenseController;
use App\Http\Controllers\BookingEntryController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\VehicleHireController;
use App\Http\Controllers\DomesticShipmentController;
use App\Http\Controllers\LoadingChallanController;

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
// Route::get('/dashboard', [UserController::class, 'dashboard'])
//     ->name('user.dashboard');
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
    Route::get('/admin-users/index', [SuperAdminController::class, 'index'])
        ->name('admin.users.index');
    Route::delete('/admin-users/{id}', [SuperAdminController::class, 'destroy'])
        ->name('admin.users.destroy');
    Route::get('/admin-users/export/excel', [SuperAdminController::class, 'exportExcel'])->name('users.export.excel');
    Route::get('/admin-users/export/pdf', [SuperAdminController::class, 'exportPDF'])->name('users.export.pdf');
});


// Allow either a legacy 'user' role or new 'admin' tenant owner role
Route::middleware(['auth'])->group(function () {

    Route::get('/vendor-payment-report', [VehicleHireController::class, 'vendorPaymentReport'])->name('vendor.payment.report');


    Route::get(
        '/vendor-payment-report/export',
        [VehicleHireController::class, 'exportVendorPayment']
    )->name('vendor.payment.export');


    // View-only routes (require basic authentication)
    Route::middleware(['permission:pod.shipments'])->get('/domestic-shipment/index', [DomesticShipmentController::class, 'index'])->name('domestic.shipment.index');
    Route::get('/new_pod/{id}', [DomesticShipmentController::class, 'show'])->name('domestic.shipment.pod');

    // Create routes (require create shipments permission)
    Route::middleware(['permission:create.shipments'])->group(function () {

        Route::get(
            '/vendor-payment-report/export',
            [VehicleHireController::class, 'exportVendorPayment']
        )->name('vendor.payment.export');


        // View-only routes (require basic authentication)
        Route::middleware(['permission:shipment.view'])->get('/domestic-shipment/index', [DomesticShipmentController::class, 'index'])->name('domestic.shipment.index');
        Route::get('/new_pod/{id}', [DomesticShipmentController::class, 'show'])->name('domestic.shipment.pod');

        // Create routes (require create shipments permission)
        Route::middleware(['permission:shipment.create'])->group(function () {

            Route::get('/domestic-shipment/create', [DomesticShipmentController::class, 'create'])->name('domestic.shipment.create');
            Route::post('/domestic-shipment/store', [DomesticShipmentController::class, 'store'])->name('domestic.shipment.store');
        });

        // Edit/Update routes (require edit shipments permission)

        Route::middleware(['permission:edit.shipments'])->group(function () {

            Route::middleware(['permission:shipment.edit'])->group(function () {

                Route::get('/domestic-shipment/{id}/edit', [DomesticShipmentController::class, 'edit'])->name('domestic.shipment.edit');
                Route::put('/domestic-shipment/{id}', [DomesticShipmentController::class, 'update'])->name('domestic.shipment.update');
            });

            // Delete routes (require delete shipments permission)

            Route::middleware(['permission:delete.shipments'])->group(function () {
                Route::delete('/domestic-shipment/{id}', [DomesticShipmentController::class, 'destroy'])->name('domestic.shipment.destroy');
            });

            Route::middleware(['permission:shipment.delete'])->delete('/domestic-shipment/{id}', [DomesticShipmentController::class, 'destroy'])->name('domestic.shipment.destroy');


            // Report routes
            // Route::middleware(['permission:view shipments'])->get('/domestic-shipment/report', [DomesticShipmentController::class, 'report'])->name('domestic.shipment.report');

            // Vendor routes with permission checks

            Route::middleware(['permission:manage.vendors'])->group(function () {

                Route::middleware(['permission:vendor.create'])->group(function () {

                    Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
                    Route::post('/vendors/create', [VendorController::class, 'store'])->name('vendors.store');
                });
                Route::middleware(['permission:vendor.edit'])->group(function () {
                    Route::get('/vendors/{id}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
                    Route::put('/vendors/{id}', [VendorController::class, 'update'])->name('vendors.update');

                    Route::delete('/vendors/{id}', [VendorController::class, 'destroy'])->name('vendors.destroy');
                });
                Route::middleware(['permission:create.vendors'])->group(function () {
                    Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
                    Route::post('/vendors/create', [VendorController::class, 'store'])->name('vendors.store');
                });
                Route::middleware(['permission:edit.vendors'])->group(function () {
                    Route::get('/vendors/{id}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
                    Route::put('/vendors/{id}', [VendorController::class, 'update'])->name('vendors.update');
                });
                Route::middleware(['permission:delete.vendors'])->group(function () {
                    Route::delete('/vendors/{id}', [VendorController::class, 'destroy'])->name('vendors.destroy');
                });

                Route::middleware(['permission:view.vendors'])->get('/vendors/index', [VendorController::class, 'index'])->name('vendors.index');
            });
            Route::middleware(['permission:vendor.delete'])->delete('/vendors/destroy', [VendorController::class, 'destroy'])->name('vendors.destroy');
            Route::middleware(['permission:vendor.view'])->get('/vendors/index', [VendorController::class, 'index'])->name('vendors.index');


            // Branch routes (admin only for now)
            Route::middleware(['role:admin'])->group(function () {
                Route::resource('branches', BranchController::class);
            });

            Route::middleware(['permission:manage.branches'])->group(function () {
                Route::resource('branches', BranchController::class);
            });
            Route::middleware(['permission:create.branches'])->group(function () {
                Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
                Route::post('/branches/store', [BranchController::class, 'store'])->name('branches.store');
            });

            Route::middleware(['permission:edit.branches'])->group(function () {
                Route::get('/branches/{id}/edit', [BranchController::class, 'edit'])->name('branches.edit');
                Route::put('/branches/{id}', [BranchController::class, 'update'])->name('branches.update');
            });

            Route::middleware(['permission:delete.branches'])->group(function () {
                Route::delete('/branches/{id}', [BranchController::class, 'destroy'])->name('branches.destroy');
            });

            Route::middleware(['permission:view.branches'])->get('/branches/index', [BranchController::class, 'index'])->name('branches.index');

            // Customer routes with permission checks

            Route::middleware(['permission:manage.customers'])->group(function () {

                Route::middleware(['permission:customer.create'])->group(function () {

                    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
                    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
                });
                Route::middleware(['permission:customer.edit'])->group(function () {
                    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
                    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
                });

                Route::middleware(['permission:create.customers'])->group(function () {
                    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
                    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
                });
                Route::middleware(['permission:edit.customers'])->group(function () {
                    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
                    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
                });
                Route::middleware(['permission:delete.customers'])->group(function () {
                    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
                });
                Route::middleware(['permission:view.customers'])->get('/customers/index', [CustomerController::class, 'index'])->name('customers.index');

                Route::middleware(['permission:vehicle-create'])->group(function () {
                    Route::middleware(['permission:view.customers'])->get('/customers/index', [CustomerController::class, 'index'])->name('customers.index');


                    Route::middleware(['permission:manage.vehicles'])->group(function () {
                        Route::resource('vehicles', VehicleController::class);
                    });

                    Route::middleware(['permission:create.vehicles'])->group(function () {
                        Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
                        Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
                    });

                    Route::middleware(['permission:edit.vehicles'])->group(function () {
                        Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
                        Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
                    });

                    Route::middleware(['permission:delete.vehicles'])->group(function () {
                        Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
                    });

                    Route::middleware(['permission:view.vehicles'])->get('/add-expenses/index', [AddExpenseController::class, 'index'])->name('add-expenses.index');

                    Route::middleware(['permission:manage.shipments'])->group(function () {
                        Route::get('/domestic-shipment/create', [DomesticShipmentController::class, 'create'])->name('domestic.shipment.create');
                        Route::post('/domestic-shipment/store', [DomesticShipmentController::class, 'store'])->name('domestic.shipment.store');
                        Route::get('/domestic-shipment/{id}/edit', [DomesticShipmentController::class, 'edit'])->name('domestic.shipment.edit');
                        Route::put('/domestic-shipment/{id}', [DomesticShipmentController::class, 'update'])->name('domestic.shipment.update');
                        Route::delete('/domestic-shipment/{id}', [DomesticShipmentController::class, 'destroy'])->name('domestic.shipment.destroy');
                    });

                    Route::middleware(['permission:create.shipments'])->group(function () {
                        Route::get('/domestic-shipment/create', [DomesticShipmentController::class, 'create'])->name('domestic.shipment.create');
                        Route::post('/domestic-shipment/store', [DomesticShipmentController::class, 'store'])->name('domestic.shipment.store');
                    });

                    Route::middleware(['permission:edit.shipments'])->group(function () {
                        Route::get('/domestic-shipment/{id}/edit', [DomesticShipmentController::class, 'edit'])->name('domestic.shipment.edit');
                        Route::put('/domestic-shipment/{id}', [DomesticShipmentController::class, 'update'])->name('domestic.shipment.update');
                    });

                    Route::middleware(['permission:delete.shipments'])->group(function () {
                        Route::delete('/domestic-shipment/{id}', [DomesticShipmentController::class, 'destroy'])->name('domestic.shipment.destroy');
                    });

                    Route::middleware(['permission:view shipments'])->get('/domestic-shipment/index', [DomesticShipmentController::class, 'index'])->name('domestic.shipment.index');

                    Route::middleware(['permission:manage.drivers'])->group(function () {
                        Route::resource('drivers', DriverController::class);
                    });

                    Route::middleware(['permission:create.drivers'])->group(function () {
                        Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
                        Route::post('/drivers/store', [DriverController::class, 'store'])->name('drivers.store');
                    });

                    Route::middleware(['permission:edit.drivers'])->group(function () {
                        Route::get('/drivers/{id}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
                        Route::put('/drivers/{id}', [DriverController::class, 'update'])->name('drivers.update');
                    });

                    Route::middleware(['permission:delete.drivers'])->group(function () {
                        Route::delete('/drivers/{id}', [DriverController::class, 'destroy'])->name('drivers.destroy');
                    });

                    Route::middleware(['permission:view.drivers'])->get('/drivers/index', [DriverController::class, 'index'])->name('drivers.index');


                    Route::middleware(['permission:manage.expense'])->group(function () {
                        Route::resource('add-expenses', AddExpenseController::class);
                    });

                    Route::middleware(['permission:create.expense'])->group(function () {
                        Route::get('/add-expenses/create', [AddExpenseController::class, 'create'])->name('add-expenses.create');
                        Route::post('/add-expenses/store', [AddExpenseController::class, 'store'])->name('add-expenses.store');
                    });

                    Route::middleware(['permission:edit.expense'])->group(function () {
                        Route::get('/add-expenses/{id}/edit', [AddExpenseController::class, 'edit'])->name('add-expenses.edit');
                        Route::put('/add-expenses/{id}', [AddExpenseController::class, 'update'])->name('add-expenses.update');
                    });

                    Route::middleware(['permission:delete.expense'])->group(function () {
                        Route::delete('/add-expenses/{id}', [AddExpenseController::class, 'destroy'])->name('add-expenses.destroy');
                    });

                    Route::middleware(['permission:view.expense'])->get('/add-expenses/index', [AddExpenseController::class, 'index'])->name('add-expenses.index');

                    Route::middleware(['permission:customer.delete'])->delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');


                    Route::middleware(['permission:customer.view'])->get('/customers/index', [CustomerController::class, 'index'])->name('customers.index');
                    Route::middleware(['permission:vehicle.create'])->group(function () {
                        Route::get('vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
                        Route::post('vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
                    });
                    Route::middleware(['permission:vehicle.edit'])->group(function () {
                        Route::get('vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
                        Route::put('vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
                    });
                    Route::middleware(['permission:vehicle.view'])->get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
                    Route::middleware(['permission:vehicle.show'])->get('vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
                    Route::middleware(['permission:vehicle.delete'])->delete('vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

                    Route::middleware(['permission:driver.create'])->group(function () {
                        Route::get('drivers/create', [DriverController::class, 'create'])->name('drivers.create');
                        Route::post('drivers', [DriverController::class, 'store'])->name('drivers.store');
                    });
                    Route::middleware(['permission:driver.edit'])->group(function () {
                        Route::get('drivers/{driver}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
                        Route::put('drivers/{driver}', [DriverController::class, 'update'])->name('drivers.update');
                    });
                    Route::middleware(['permission:driver.view'])->get('drivers', [DriverController::class, 'index'])->name('drivers.index');
                    Route::middleware(['permission:driver.show'])->get('drivers/{driver}', [DriverController::class, 'show'])->name('drivers.show');
                    Route::middleware(['permission:driver.delete'])->delete('drivers/{driver}', [DriverController::class, 'destroy'])->name('drivers.destroy');

                    Route::middleware(['permission:expense.create'])->group(function () {
                        Route::get('add-expenses/create', [AddExpenseController::class, 'create'])->name('add-expenses.create');
                        Route::post('add-expenses', [AddExpenseController::class, 'store'])->name('add-expenses.store');
                    });
                    Route::middleware(['permission:expense.edit'])->group(function () {
                        Route::get('add-expenses/{add_expense}/edit', [AddExpenseController::class, 'edit'])->name('add-expenses.edit');
                        Route::put('add-expenses/{add_expense}', [AddExpenseController::class, 'update'])->name('add-expenses.update');
                    });
                    Route::middleware(['permission:expense.view'])->get('add-expenses', [AddExpenseController::class, 'index'])->name('add-expenses.index');
                    Route::middleware(['permission:expense.show'])->get('add-expenses/{add_expense}', [AddExpenseController::class, 'show'])->name('add-expenses.show');
                    Route::middleware(['permission:expense.delete'])->delete('add-expenses/{add_expense}', [AddExpenseController::class, 'destroy'])->name('add-expenses.destroy');


                    Route::middleware(['permission:manage.vehicle_hires'])->group(function () {
                        Route::get('/vehicle_hires/create', [VehicleHireController::class, 'create'])->name('vehicle_hires.create');
                        Route::post('/vehicle_hires/store', [VehicleHireController::class, 'store'])->name('vehicle_hires.store');
                        Route::get('/vehicle_hires/index', [VehicleHireController::class, 'index'])->name('vehicle_hires.index');
                        Route::get('/vehicle_hires/{id}/edit', [VehicleHireController::class, 'edit'])->name('vehicle_hires.edit');
                        Route::put('/vehicle_hires/{id}', [VehicleHireController::class, 'update'])->name('vehicle_hires.update');
                        Route::delete('/vehicle_hires/{id}', [VehicleHireController::class, 'destroy'])->name('vehicle_hires.destroy');
                    });
                    Route::middleware(['permission:create.vehicle_hires'])->group(function () {
                        Route::get('/vehicle_hires/create', [VehicleHireController::class, 'create'])->name('vehicle_hires.create');
                        Route::post('/vehicle_hires/store', [VehicleHireController::class, 'store'])->name('vehicle_hires.store');
                    });
                    Route::middleware(['permission:edit.vehicle_hires'])->group(function () {
                        Route::get('/vehicle_hires/{id}/edit', [VehicleHireController::class, 'edit'])->name('vehicle_hires.edit');
                        Route::put('/vehicle_hires/{id}', [VehicleHireController::class, 'update'])->name('vehicle_hires.update');
                    });
                    Route::middleware(['permission:delete.vehicle_hires'])->group(function () {
                        Route::delete('/vehicle_hires/{id}', [VehicleHireController::class, 'destroy'])->name('vehicle_hires.destroy');
                    });

                    Route::middleware(['permission:view.vehicle_hires'])->get('/vehicle_hires/index', [VehicleHireController::class, 'index'])->name('vehicle_hires.index');

                    Route::post('/domestic/print', [DomesticShipmentController::class, 'print'])
                        ->name('domestic.shipment.print');

                    Route::get('/domestic/report', [DomesticShipmentController::class, 'report'])
                        ->name('domestic.shipment.report');

                    Route::middleware(['permission:company.create'])->group(function () {
                        Route::get('company/create', [AddCompanyController::class, 'create'])->name('company.create');
                        Route::post('company', [AddCompanyController::class, 'store'])->name('company.store');
                    });
                    Route::middleware(['permission:company.edit'])->group(function () {
                        Route::get('company/{company}/edit', [AddCompanyController::class, 'edit'])->name('company.edit');
                        Route::put('company/{company}', [AddCompanyController::class, 'update'])->name('company.update');
                    });
                    Route::middleware(['permission:company.view'])->get('company', [AddCompanyController::class, 'index'])->name('company.index');
                    Route::middleware(['permission:company.show'])->get('company/{company}', [AddCompanyController::class, 'show'])->name('company.show');
                    Route::middleware(['permission:company.delete'])->delete('company/{company}', [AddCompanyController::class, 'destroy'])->name('company.delete');

                    Route::middleware(['permission:vehicle_hire.create'])->group(function () {
                        Route::get('/vehicle_hires/create', [VehicleHireController::class, 'create'])->name('vehicle_hires.create');
                        Route::post('/vehicle_hires/store', [VehicleHireController::class, 'store'])->name('vehicle_hires.store');
                    });
                    Route::middleware(['permission:vehicle_hire.edit'])->group(function () {
                        Route::get('/vehicle_hires/{id}/edit', [VehicleHireController::class, 'edit'])->name('vehicle_hires.edit');
                        Route::put('/vehicle_hires/{id}', [VehicleHireController::class, 'update'])->name('vehicle_hires.update');
                    });
                    Route::middleware(['permission:vehicle_hire.view'])->get('/vehicle_hires/index', [VehicleHireController::class, 'index'])->name('vehicle_hires.index');
                    Route::middleware(['permission:vehicle_hire.delete'])->delete('/vehicle_hires/{id}', [VehicleHireController::class, 'destroy'])->name('vehicle_hires.destroy');


                    Route::middleware(['permission:manage.expense'])->group(function () {
                        Route::resource('add-expenses', AddExpenseController::class);
                    });

                    Route::middleware(['permission:create.expense'])->group(function () {
                        Route::get('/add-expenses/create', [AddExpenseController::class, 'create'])->name('add-expenses.create');
                        Route::post('/add-expenses/store', [AddExpenseController::class, 'store'])->name('add-expenses.store');
                    });

                    Route::middleware(['permission:edit.expense'])->group(function () {
                        Route::get('/add-expenses/{id}/edit', [AddExpenseController::class, 'edit'])->name('add-expenses.edit');
                        Route::put('/add-expenses/{id}', [AddExpenseController::class, 'update'])->name('add-expenses.update');
                    });

                    Route::middleware(['permission:delete.expense'])->group(function () {
                        Route::delete('/add-expenses/{id}', [AddExpenseController::class, 'destroy'])->name('add-expenses.destroy');
                    });

                    Route::middleware(['permission:view.expense'])->get('/add-expenses/index', [AddExpenseController::class, 'index'])->name('add-expenses.index');


                    Route::middleware(['permission:manage.companies'])->group(function () {
                        Route::resource('company', AddCompanyController::class);
                    });

                    Route::middleware(['permission:create.companies'])->group(function () {
                        Route::get('/company/create', [AddCompanyController::class, 'create'])->name('company.create');
                        Route::post('/company/store', [AddCompanyController::class, 'store'])->name('company.store');
                    });
                    Route::middleware(['permission:edit.companies'])->group(function () {
                        Route::get('/company/{id}/edit', [AddCompanyController::class, 'edit'])->name('company.edit');
                        Route::put('/company/{id}', [AddCompanyController::class, 'update'])->name('company.update');
                    });
                    Route::middleware(['permission:delete.companies'])->group(function () {
                        Route::delete('/company/{id}', [AddCompanyController::class, 'destroy'])->name('company.destroy');
                    });

                    Route::middleware(['permission:view.companies'])->get('/vehicle_hires/index', [AddCompanyController::class, 'index'])->name('company.index');


                    Route::middleware(['permission:manage.vehicle_hires'])->group(function () {
                        Route::get('/vehicle_hires/create', [VehicleHireController::class, 'create'])->name('vehicle_hires.create');
                        Route::post('/vehicle_hires/store', [VehicleHireController::class, 'store'])->name('vehicle_hires.store');
                        Route::get('/vehicle_hires/index', [VehicleHireController::class, 'index'])->name('vehicle_hires.index');
                        Route::get('/vehicle_hires/{id}/edit', [VehicleHireController::class, 'edit'])->name('vehicle_hires.edit');
                        Route::put('/vehicle_hires/{id}', [VehicleHireController::class, 'update'])->name('vehicle_hires.update');
                        Route::delete('/vehicle_hires/{id}', [VehicleHireController::class, 'destroy'])->name('vehicle_hires.destroy');
                    });
                    Route::middleware(['permission:create.vehicle_hires'])->group(function () {
                        Route::get('/vehicle_hires/create', [VehicleHireController::class, 'create'])->name('vehicle_hires.create');
                        Route::post('/vehicle_hires/store', [VehicleHireController::class, 'store'])->name('vehicle_hires.store');
                    });
                    Route::middleware(['permission:edit.vehicle_hires'])->group(function () {
                        Route::get('/vehicle_hires/{id}/edit', [VehicleHireController::class, 'edit'])->name('vehicle_hires.edit');
                        Route::put('/vehicle_hires/{id}', [VehicleHireController::class, 'update'])->name('vehicle_hires.update');
                    });
                    Route::middleware(['permission:delete.vehicle_hires'])->group(function () {
                        Route::delete('/vehicle_hires/{id}', [VehicleHireController::class, 'destroy'])->name('vehicle_hires.destroy');
                    });

                    Route::get('/booking_entries/create', [BookingEntryController::class, 'create'])->name('booking_entries.create');
                    Route::post('/booking_entries/store', [BookingEntryController::class, 'store'])->name('booking_entries.store');
                    Route::get('/booking_entries/index', [BookingEntryController::class, 'index'])->name('booking_entries.index');
                    Route::get('/booking_entries/{id}/edit', [BookingEntryController::class, 'edit'])->name('booking_entries.edit');
                    Route::put('/booking_entries/{id}', [BookingEntryController::class, 'update'])->name('booking_entries.update');
                    Route::delete('/booking_entries/{id}', [BookingEntryController::class, 'destroy'])->name('booking_entries.destroy');


                    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
                    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
                    Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');
                    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
                    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
                    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

                    Route::get('/ledgers/create', [LedgerController::class, 'create'])->name('ledgers.create');
                    Route::post('/ledgers/store', [LedgerController::class, 'store'])->name('ledgers.store');
                    Route::get('/ledgers/index', [LedgerController::class, 'index'])->name('ledgers.index');
                    Route::get('/ledgers/{id}/edit', [LedgerController::class, 'edit'])->name('ledgers.edit');
                    Route::put('/ledgers/{id}', [LedgerController::class, 'update'])->name('ledgers.update');
                    Route::delete('/ledgers/{id}', [LedgerController::class, 'destroy'])->name('ledgers.destroy');

                    Route::resource('brokers', BrokerController::class);
                    Route::resource('loading-challan', LoadingChallanController::class);


                    Route::middleware(['permission:view.vehicle_hires'])->get('/vehicle_hires/index', [VehicleHireController::class, 'index'])->name('vehicle_hires.index');

                    Route::middleware(['permission:shipment.print'])->post('/domestic/print', [DomesticShipmentController::class, 'print'])->name('domestic.shipment.print');
                    Route::middleware(['permission:shipment.report'])->get('/domestic/report', [DomesticShipmentController::class, 'report'])->name('domestic.shipment.report');
                });
            });
        });
    });
});



// booking_entries

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

    Route::middleware(['permission:view.report'])->group(function () {
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


Route::delete('/users/{id}', [SuperAdminController::class, 'delete'])->name('users.delete');
