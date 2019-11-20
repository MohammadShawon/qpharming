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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

    Auth::routes();

/*
 *  API Resource
 * */
    Route::get('api/item','Admin\Api\ProductController@index');
    Route::get('api/saletemp','Admin\Api\SaleTempController@index');
    Route::post('api/saletemp','Admin\Api\SaleTempController@store');
    Route::put('api/saletemp/{id}','Admin\Api\SaleTempController@update');
    Route::delete('api/saletemp/{id}','Admin\Api\SaleTempController@destroy');

    Route::get('api/allitem','Admin\Api\ProductController@allItem');
    Route::get('api/receivingtemp','Admin\Api\PurchaseTempController@index');
    Route::post('api/receivingtemp','Admin\Api\PurchaseTempController@store');
    Route::put('api/receivingtemp/{id}','Admin\Api\PurchaseTempController@update');
    Route::delete('api/receivingtemp/{id}','Admin\Api\PurchaseTempController@destroy');



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
    Route::get('farmer/{id}/invoice','FarmerInvoiceController@create');
    Route::get('farmer/invoice/{id}','FarmerInvoiceController@show')->name('farmerinvoice.show');
    Route::post('farmer/{id}/invoice','FarmerInvoiceController@store');
    Route::post('farmer/{id}/payment','FarmerInvoiceController@payment')->name('payment.advance');
//    Route::resource('farmerinvoice', 'FarmerInvoiceController');
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
    /*
     * Import Product
     * */
    Route::post('import/product','Import\ProductImportController@import')->name('product.import');

    /* Farmer Batch routes */
    Route::get('farmer/{id}/batch/create', 'FarmerBatchController@create');
    Route::post('farmer/{id}/batch', 'FarmerBatchController@store');
    Route::get('farmer/{id}/batch/{batch_id}/edit', 'FarmerBatchController@edit');
    Route::patch('farmer/{id}/batch/{batch_id}', 'FarmerBatchController@update');
    Route::delete('farmer/{id}/batch/{batch_id}', 'FarmerBatchController@destroy');

//    Route::get('farmer/profile', function (){ return view('admin.farmer.view2'); });

    Route::post('farmer/records/{id}', 'FarmerRecordController@store')->name('daily-record');

//    Route::get('farmer-record-dashboard', 'FarmerRecordDashboardController@index');
//    Route::get('farmer-record-dashboard2', 'FarmerRecordDashboardController@index2');

    /*
     * Branch Wise Farmer
     * */

    Route::get('info/branch', 'BranchInfoController@index');
    Route::get('particular-branch/{branch_id}/farmers', 'BranchFarmerController@farmerList');




    Route::get('notifications', 'NotificationsController@allNotification');
    Route::get('markallasread', 'NotificationsController@markallasread');



    /*
     * Sales
     * */
    Route::resource('sales','SaleInvoice\SaleInvoiceController');


    /*
     * Purchase
     * */
    Route::resource('purchases','PurchaseInvoice\PurchaseInvoiceController');
    /*
     * All Transactions
     * */
    Route::get('transactions','Transaction\TransactionController@index')->name('transaction.all');

    /*
     * Stocks Route
     * */
    Route::get('chicks/stocks','Stocks\ChicksStockController@index')->name('chicks.stocks');
    Route::get('feed/stocks','Stocks\FeedStockController@index')->name('feed.stocks');
    Route::get('medicine/stocks','Stocks\MedicineStockController@index')->name('medicine.stocks');
    Route::get('stocks/transfer','Stocks\StockTransferController@createStockTransfer')->name('stocks.transfer.create');
    Route::post('stocks/transfer','Stocks\StockTransferController@transfer')->name('stocks.transfer.store');
    /*
     * Ledger Records Route
     * */
    Route::get('chicks/records','Records\ChicksRecordController@index')->name('chicks.records');
    Route::get('feed/records','Records\FeedRecordController@index')->name('feed.records');
    Route::get('medicine/records','Records\MedicineRecordController@index')->name('medicine.records');
    Route::get('records/farmer','Records\FarmerRecordController@index')->name('farmer.records');
    Route::get('records/company','Records\CompanyRecordController@index')->name('company.records');
    Route::get('records/company/{id}','Records\CompanyRecordController@show')->name('company.ledger');

    /*
     * All Reports Route
     * */
    Route::get('daily/reports','Reports\DailyReportController@index')->name('daily.reports');
    Route::post('daily/reports','Reports\DailyReportController@store')->name('daily.reports.post');
//    Route::get('weekly/reports','Reports\WeeklyReportController@index')->name('weekly.reports');
    Route::get('monthly/reports','Reports\MonthlyReportController@index')->name('monthly.reports');
    Route::post('monthly/reports','Reports\MonthlyReportController@show')->name('monthly.reports.post');

    Route::get('daily/reports/topsheet','Reports\DailyReportController@topsheet');
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

Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');


/*For checking errors page  START*/
//
//Route::get('401', function (){ return view('errors.401'); });
//Route::get('403', function (){ return view('errors.403'); });
//Route::get('404', function (){ return view('errors.404'); });
//Route::get('500', function (){ return view('errors.500'); });
//Route::get('500', function (){ return view('errors.500'); });

/*For checking errors page  END*/

/*Language route START*/
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
/*Language route END*/



Route::get('/', 'Admin\DashboardController@index')->name('home');
