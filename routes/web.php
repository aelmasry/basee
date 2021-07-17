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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Users
    Route::get('/users/profile', 'UserController@profile')->name('users.profile');
    Route::get('/users/login-as-user/{id}', 'UserController@loginAsUser')->name('users.login-as-user');
    Route::post('/users/remove-media', 'UserController@removeMedia');
    Route::resource('/users', 'UserController');

    // Permissions and roles
    // Route::group(['middleware' => ['permission:permissions.*']], function () {
    Route::any('/permissions/role-has-permission', 'PermissionController@roleHasPermission');
    Route::get('/permissions/refresh-permissions', 'PermissionController@refreshPermissions');
    // });

    // Route::group(['middleware' => ['permission:permissions.*']], function () {
    Route::any('/permissions/give-permission-to-role', 'PermissionController@givePermissionToRole');
    Route::post('/permissions/revoke-permission-to-role', 'PermissionController@revokePermissionToRole');
    // });

    Route::resource('/permissions', 'PermissionController');
    Route::resource('/roles', 'RoleController');

    Route::resource('/categories', 'CategoryController')->except([
        'show'
    ]);
});

// media manager
Route::get('storage/app/public/{id}/{conversion}/{filename?}', 'UploadController@storage');

Route::middleware('auth')->group(function () {
    Route::post('uploads/store', 'UploadController@store')->name('medias.create');
    Route::get('uploads/all/{collection?}', 'UploadController@all');
    Route::get('uploads/collectionsNames', 'UploadController@collectionsNames');
    Route::post('uploads/clear', 'UploadController@clear')->name('medias.delete');
    Route::get('medias', 'UploadController@index')->name('medias');
    Route::get('uploads/clear-all', 'UploadController@clearAll');
});
