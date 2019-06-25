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



// Route::get('/', function (\Illuminate\Http\Request $request) {
//     $user = $request->user();
//     dump($user->refreshPermissions('delete'));
// });

// Route::group(['as'=>'admin.', 'prefix' => 'manager', 'namespace'=>'Admin','middleware' => 'role:manager'], function () {

//     Route::resource('area', 'AreaController');
    
// });

Auth::routes();


Route::group(['as'=>'admin.', 'namespace'=>'Admin','middleware' => ['role:superadmin|admin|manager|employee,create']], function () {
    

    Route::resource('area', 'AreaController');
    Route::resource('category', 'CategoryController');
    Route::resource('sub-category', 'SubCategoryController');
    Route::resource('branch', 'BranchController');
    Route::resource('purposehead', 'PurposeheadCotroller');
    Route::resource('expensehead', 'ExpenseheadCotroller');
    Route::resource('expense', 'ExpenseCotroller');
    Route::resource('farmer', 'FarmerController');
    Route::resource('company', 'CompanyController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('product-price', 'ProductPriceController');
    Route::resource('unit', 'UnitController');
    Route::resource('unit-convert', 'UnitConvertController');
    Route::get('notifications', 'NotificationsController@allNotification');
    Route::get('markallasread', 'NotificationsController@markallasread');

    
    Route::get('info/branch', 'BranchInfoController@index');
    
});

/* Super Admin route start */

Route::group(['as'=>'super-admin.', 'namespace'=>'SuperAdmin', ], function () {

    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
   
});

/* Super Admin route end */


// Route::get('dashboard', function () {
//     return view('admin.dashboard');
// });

Route::get('dashboard', 'Admin\DashboardController@index');


/*For checking errors page  START*/

Route::get('401', function (){ return view('errors.401'); });
Route::get('403', function (){ return view('errors.403'); });
Route::get('404', function (){ return view('errors.404'); });
Route::get('500', function (){ return view('errors.500'); });

/*For checking errors page  END*/

/*Language route START*/
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
/*Language route END*/



Route::get('/', 'Admin\DashboardController@index')->name('home');
