<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'getEmail'])->name('forgot.password');
Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'postEmail'])->name('reset.password');
Route::get('/reset-password/{token}', [App\Http\Controllers\ResetPasswordController::class, 'getPassword'])->name('reset.view');
Route::post('/reset-password', [App\Http\Controllers\ResetPasswordController::class, 'updatePassword'])->name('password.resetnew');

Route::group(['middleware' => ['auth']],function(){

	Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');
	

	Route::get('admin/roles', [App\Http\Controllers\Admin\RolesController::class, 'index'])->name('admin.roles');
	Route::post('admin/roles/paginate', [App\Http\Controllers\Admin\RolesController::class, 'paginate'])->name('admin.roles.paginate');
	Route::get('admin/roles/add', [App\Http\Controllers\Admin\RolesController::class, 'add'])->name('admin.roles.add');
	Route::post('admin/roles/create', [App\Http\Controllers\Admin\RolesController::class, 'create'])->name('admin.roles.create');
	Route::get('admin/roles/view/{id}', [App\Http\Controllers\Admin\RolesController::class, 'view'])->name('admin.roles.view');
	Route::get('admin/roles/edit/{id}', [App\Http\Controllers\Admin\RolesController::class, 'edit'])->name('admin.roles.edit');
	Route::post('admin/roles/update', [App\Http\Controllers\Admin\RolesController::class, 'update'])->name('admin.roles.update');
	Route::get('admin/roles/delete/{id}', [App\Http\Controllers\Admin\RolesController::class, 'delete'])->name('admin.roles.delete');

	Route::get('admin/permissions', [App\Http\Controllers\Admin\PermissionsController::class, 'index'])->name('admin.permissions');
	Route::post('admin/permissions/paginate', [App\Http\Controllers\Admin\PermissionsController::class, 'paginate'])->name('admin.permissions.paginate');
	Route::get('admin/permissions/add', [App\Http\Controllers\Admin\PermissionsController::class, 'add'])->name('admin.permissions.add');
	Route::post('admin/permissions/create', [App\Http\Controllers\Admin\PermissionsController::class, 'create'])->name('admin.permissions.create');
	Route::get('admin/permissions/view/{id}', [App\Http\Controllers\Admin\PermissionsController::class, 'view'])->name('admin.permissions.view');
	Route::get('admin/permissions/edit/{id}', [App\Http\Controllers\Admin\PermissionsController::class, 'edit'])->name('admin.permissions.edit');
	Route::post('admin/permissions/update', [App\Http\Controllers\Admin\PermissionsController::class, 'update'])->name('admin.permissions.update');
	Route::get('admin/permissions/delete/{id}', [App\Http\Controllers\Admin\PermissionsController::class, 'delete'])->name('admin.permissions.delete');

	Route::get('admin/rolepermissions', [App\Http\Controllers\Admin\RolePermissionsController::class, 'index'])->name('admin.rolepermissions.index');
	Route::get('admin/rolepermissions/get/{id}', [App\Http\Controllers\Admin\RolePermissionsController::class, 'get'])->name('admin.rolepermissions.get');
	Route::post('admin/rolepermissions/update', [App\Http\Controllers\Admin\RolePermissionsController::class, 'update'])->name('admin.rolepermissions.update');

	Route::get('admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
	Route::post('admin/users/paginate', [App\Http\Controllers\Admin\UsersController::class, 'paginate'])->name('admin.users.paginate');
	Route::get('admin/users/add', [App\Http\Controllers\Admin\UsersController::class, 'add'])->name('admin.users.add');
	Route::post('admin/users/create', [App\Http\Controllers\Admin\UsersController::class, 'create'])->name('admin.users.create');
	Route::get('admin/users/view/{id}', [App\Http\Controllers\Admin\UsersController::class, 'view'])->name('admin.users.view');
	Route::get('admin/users/edit/{id}', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.users.edit');
	Route::post('admin/users/update', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
	Route::get('admin/users/delete/{id}', [App\Http\Controllers\Admin\UsersController::class, 'delete'])->name('admin.users.delete');

	Route::get('admin/customers', [App\Http\Controllers\Admin\CustomersController::class, 'index'])->name('admin.customers');
	Route::post('admin/customers/paginate', [App\Http\Controllers\Admin\CustomersController::class, 'paginate'])->name('admin.customers.paginate');
	Route::get('admin/customers/add', [App\Http\Controllers\Admin\CustomersController::class, 'add'])->name('admin.customers.add');
	Route::post('admin/customers/create', [App\Http\Controllers\Admin\CustomersController::class, 'create'])->name('admin.customers.create');
	Route::get('admin/customers/view/{id}', [App\Http\Controllers\Admin\CustomersController::class, 'view'])->name('admin.customers.view');
	Route::get('admin/customers/edit/{id}', [App\Http\Controllers\Admin\CustomersController::class, 'edit'])->name('admin.customers.edit');
	Route::post('admin/customers/update', [App\Http\Controllers\Admin\CustomersController::class, 'update'])->name('admin.customers.update');
	Route::get('admin/customers/delete/{id}', [App\Http\Controllers\Admin\CustomersController::class, 'delete'])->name('admin.customers.delete');
	
	
	Route::get('admin/customers/link/{customer_id}', [App\Http\Controllers\Admin\ProjectsController::class, 'linkProject'])->name('admin.projects.link');
	Route::post('admin/projects/linktocustomer', [App\Http\Controllers\Admin\ProjectsController::class, 'linkToCustomer'])->name('admin.projects.linkact');
	

	Route::get('admin/projects/add/{id}', [App\Http\Controllers\Admin\ProjectsController::class, 'add'])->name('admin.projects.add');
	Route::post('admin/projects/create', [App\Http\Controllers\Admin\ProjectsController::class, 'create'])->name('admin.projects.create');
	Route::get('admin/projects/view/{id}', [App\Http\Controllers\Admin\ProjectsController::class, 'view'])->name('admin.projects.view');
	Route::get('admin/projects/edit/{id}', [App\Http\Controllers\Admin\ProjectsController::class, 'edit'])->name('admin.projects.edit');
	Route::post('admin/projects/update', [App\Http\Controllers\Admin\ProjectsController::class, 'update'])->name('admin.projects.update');
	Route::get('admin/projects/delete/{id}/{customer_id}', [App\Http\Controllers\Admin\ProjectsController::class, 'delete'])->name('admin.projects.delete');

	Route::get('admin/credentials/add/{id}', [App\Http\Controllers\Admin\CredentialsController::class, 'add'])->name('admin.credentials.add');
	Route::post('admin/credentials/create', [App\Http\Controllers\Admin\CredentialsController::class, 'create'])->name('admin.credentials.create');
	Route::get('admin/credentials/view/{id}', [App\Http\Controllers\Admin\CredentialsController::class, 'view'])->name('admin.credentials.view');
	Route::get('admin/credentials/edit/{id}', [App\Http\Controllers\Admin\CredentialsController::class, 'edit'])->name('admin.credentials.edit');
	Route::post('admin/credentials/update', [App\Http\Controllers\Admin\CredentialsController::class, 'update'])->name('admin.credentials.update');
	Route::get('admin/credentials/delete/{id}', [App\Http\Controllers\Admin\CredentialsController::class, 'delete'])->name('admin.credentials.delete');
	Route::get("dashboard", [App\Http\Controllers\DashboardController::class, 'index'])->name('customer.dashboard');
	Route::get('drive', [App\Http\Controllers\DashboardController::class, 'readDrive'])->name('customer.drive');
});