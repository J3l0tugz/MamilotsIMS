<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\EmployeeController;
use App\http\Controllers\SupplierController;
use App\http\Controllers\ProductController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\MaterialController;
use App\http\Controllers\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.login');
});

Route::get('/404', function () {
    return view('pages.qrScanner');
});

// LoginControllers
Route::post('/log', [LoginController::class, 'authenticate'])->name('login');

// LogOutControllers
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('checker')->group(function () {
    // EmployeeControllers ONLY for management
    Route::get('/employees', [EmployeeController::class, 'employeeIndex'])->name('employee.index');
    Route::post('/save-employee', [EmployeeController::class, 'saveEmployee'])->name('employee.save');
    Route::get('/view-employee/{id}', [EmployeeController::class, 'getEmployee'])->name('employee.view');
    Route::post('/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');
    Route::get('/edit-employee/{id}', [EmployeeController::class, 'editEmployee'])->name('employee.edit');
    Route::post('/update-employee/{id}', [EmployeeController::class, 'updateEmployee'])->name('employee.update');

    // SupplierControllers for management
    Route::get('/suppliers', [SupplierController::class, 'supplierIndex'])->name('supplier.index');
    Route::post('/save-supplier', [SupplierController::class, 'saveSupplier'])->name('supplier.save');
    Route::post('/delete-supplier/{id}', [SupplierController::class, 'deleteSupplier'])->name('supplier.delete');
    Route::get('/edit-suplier/{id}', [SupplierController::class, 'editSupplier'])->name('supplier.edit');
    Route::post('/update-supplier/{id}', [SupplierController::class, 'updateSupplier'])->name('supplier.update');

    // / SupplierControllers for employees
    Route::get('/suppliers-employee', [SupplierController::class, 'supplierIndex'])->name('supplier.indexEmployee');
    Route::post('/save-supplier-employee', [SupplierController::class, 'saveSupplier'])->name('supplier.saveEmployee');
    Route::post('/delete-supplier-employee/{id}', [SupplierController::class, 'deleteSupplier'])->name('supplier.deleteEmployee');
    Route::get('/edit-supplier-employee/{id}', [SupplierController::class, 'editSupplier'])->name('supplier.editEmployee');
    Route::post('/update-supplier-employee/{id}', [SupplierController::class, 'updateSupplier'])->name('supplier.updateEmployee');

    // ProductControllers for management
    Route::get('/products', [ProductController::class, 'productIndex'])->name('product.index');
    Route::post('/save-product', [ProductController::class, 'saveProduct'])->name('product.save');
    Route::post('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    Route::get('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::post('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::post('/decrease-product', [ProductController::class, 'decreaseProduct'])->name('product.decrease');

    //  Route::post('/percent', [ProductController::class,'productStatus'])->name('percent');

    Route::get('/scan-products', [ProductController::class, 'scanQR'])->name('product.scan');
    Route::get('/scan-products-decrease', [ProductController::class, 'scanQRDecrease'])->name('product.scan.decrease');

    // ProductControllers for employees
    Route::get('/product-employee', [ProductController::class, 'productIndex'])->name('product.indexEmployee');
    Route::post('/save-product-employee', [ProductController::class, 'saveProduct'])->name('product.saveEmployee');
    Route::post('/delete-product-employee/{id}', [ProductController::class, 'deleteProduct'])->name('product.deleteEmployee');
    Route::get('/edit-product-employee/{id}', [ProductController::class, 'editProduct'])->name('product.editEmployee');
    Route::post('/update-product-employee/{id}', [ProductController::class, 'updateProduct'])->name('product.updateEmployee');
    Route::post('/decrease-product-employee', [ProductController::class, 'decreaseProduct'])->name('product.decreaseEmployee');

    Route::get('/scan-products-employee', [ProductController::class, 'scanQR'])->name('product.scanEmployee');
    Route::get('/scan-products-decrease-employee', [ProductController::class, 'scanQRDecrease'])->name('product.scan.decreaseEmployee');

    // DashboardControllers for management
    Route::get('/dashboard', [DashboardController::class, 'dashboardIndex'])->name('dashboard.index');

    // DashboardControllers for employees
    Route::get('/dashboard-employee', [DashboardController::class, 'dashboardIndex'])->name('dashboard.indexEmployee');

    // RawMaterialControllers for management
    Route::get('/raw-materials', [MaterialController::class, 'materialIndex'])->name('material.index');
    Route::post('/save-materials', [MaterialController::class, 'saveMaterial'])->name('material.save');
    Route::post('/delete-materials/{id}', [MaterialController::class, 'deleteMaterial'])->name('material.delete');
    Route::get('/edit-materials/{id}', [MaterialController::class, 'editMaterial'])->name('material.edit');
    Route::post('/update-materials/{id}', [MaterialController::class, 'updateMaterial'])->name('material.update');

    // RawMaterialControllers for employees
    Route::get('/materials-employee', [MaterialController::class, 'materialIndex'])->name('material.indexEmployee');
    Route::post('/save-materials-employee', [MaterialController::class, 'saveMaterial'])->name('material.saveEmployee');
    Route::post('/delete-materials-employee/{id}', [MaterialController::class, 'deleteMaterial'])->name('material.deleteEmployee');
    Route::get('/edit-materials-employee/{id}', [MaterialController::class, 'editMaterial'])->name('material.editEmployee');
    Route::post('/update-materials-employee/{id}', [MaterialController::class, 'updateMaterial'])->name('material.updateEmployee');

    // Reset Password for users
    Route::post('/password-reset/{id}', [EmployeeController::class, 'resetPassword'])->name('employee.resetPassword');
});


