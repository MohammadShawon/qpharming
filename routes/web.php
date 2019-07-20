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

/*
 *  API Resource
 * */
    Route::get('api/item','Admin\Api\ProductController@index');
    Route::get('api/saletemp','Admin\Api\SaleTempController@index');
    Route::post('api/saletemp','Admin\Api\SaleTempController@store');


/*
 * Routes Through Roles
 * */
Route::group(['as'=>'admin.', 'namespace'=>'Admin','middleware' => ['role:superadmin|admin|manager|employee,create']], function () {
    

    Route::resource('area', 'AreaController');
    Route::resource('category', 'CategoryController');
    Route::resource('sub-category', 'SubCategoryController');
    Route::resource('branch', 'BranchController');
    Route::resource('purposehead', 'PurposeheadCotroller');
    Route::resource('expensehead', 'ExpenseheadCotroller');
    Route::resource('expense', 'ExpenseCotroller');
    Route::resource('farmer', 'FarmerController');
    /*
     * Customer Resource
     * */
    Route::resource('customer','CustomerController');
    /*
     * Company Resource
     * */
    Route::resource('company', 'CompanyController');
    Route::resource('user', 'UserController');
    Route::resource('product', 'ProductController');
    Route::resource('product-price', 'ProductPriceController');
    Route::resource('unit', 'UnitController');
    Route::resource('unit-convert', 'UnitConvertController');
    Route::resource('bank', 'BankController');
    Route::resource('payment', 'PaymentController');
    Route::resource('collection', 'CollectionController');
    // Route::resource('farmer-records', 'FarmerRecordsController');

    /* Farmer Batch routes */
    Route::get('farmer/{id}/batch/create', 'FarmerBatchController@create');
    Route::post('farmer/{id}/batch', 'FarmerBatchController@store');
    Route::get('farmer/{id}/batch/{batch_id}/edit', 'FarmerBatchController@edit');
    Route::patch('farmer/{id}/batch/{batch_id}', 'FarmerBatchController@update');
    Route::delete('farmer/{id}/batch/{batch_id}', 'FarmerBatchController@destroy');
   
    
    
    Route::post('farmer/records/{id}', 'FarmerRecordController@store')->name('daily-record');
    


     // Route::get('farmer-record-dashboard', 'FarmerRecordDashboardController@index');
    // Route::get('farmer-record-dashboard2', 'FarmerRecordDashboardController@index2');


    Route::get('notifications', 'NotificationsController@allNotification');
    Route::get('markallasread', 'NotificationsController@markallasread');

    
    Route::get('info/branch', 'BranchInfoController@index');

    /*
     * Sales
     * */
    Route::resource('sales','SaleInvoice\SaleInvoiceController');


    /*
     * Purchase
     * */
    Route::resource('purchases','PurchaseInvoice\PurchaseInvoiceController');
    
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
