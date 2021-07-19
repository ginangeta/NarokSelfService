<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SBPController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\SeasonalController;
use App\Http\Controllers\ParkingPenaltiesController;

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

Route::get('/', [SiteController::class, 'home'])->name('home');

// Authentication
// Route::get('forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
// Route::post('authenticate', 'AuthController@authenticate')->name('authenticate');
// Route::post('registration', 'AuthController@registration')->name('registration');
// Route::post('password-request', 'AuthController@requestPassword')->name('password.request');
// Route::post('change-password', 'AuthController@changePassword')->name('password.change');
// Route::get('newpassword', 'AuthController@newPassword')->name('password.new');
// Route::post('password-reset', 'AuthController@resetPassword')->name('password.reset');
// Route::get('user-password-reset', 'AuthController@userResetPassword')->name('user-password-reset');
// Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/password-request', [AuthController::class, 'requestPassword'])->name('password.request');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
Route::get('/newpassword', [AuthController::class, 'newpassword'])->name('password.new');
Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::get('/user-password-reset', [AuthController::class, 'userResetPassword'])->name('user-password-reset');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/signup', [SiteController::class, 'signup'])->name('signup');


Route::group(['middleware' => ['active']], function () {
    //PARKING
    //Parking routes
    Route::get('get-parking-receipt/{id}', [ParkingController::class, 'getParkingReceipt'])->name('get-parking-receipt');
    Route::get('view-parking-receipt/{id}', [ParkingController::class, 'viewParkingReceipt'])->name('view-parking-receipt');
    Route::get('get-offstreet-parking-receipt/{id}', [ParkingController::class, 'getOffstreetParkingReceipt'])->name('get-offstreet-parking-receipt');
    Route::get('view-offstreet-parking-receipt/{id}', [ParkingController::class, 'viewOffstreetParkingReceipt'])->name('view-offstreet-parking-receipt');
    
    //New parking receipts
    Route::get('parking-receipts-for-{id}', [ParkingController::class, 'receiptsList'])->name('parking-receipts');

    //Offstreet
    Route::get('offstreet-parking', [ParkingController::class, 'offstreetParking'])->name('offstreet-parking');
    Route::post('get-offstreet-charge', [ParkingController::class, 'offstreetParkingPayment'])->name('get-offstreet-charge');

    //Daily
    Route::get('daily-parking', [ParkingController::class, 'dailyParking'])->name('daily-parking');
    Route::get('confirm-daily-parking-details', [ParkingController::class, 'confirmDailyParkingDetails'])->name('confirm-daily-parking-details');

    //Parking penalties
    Route::get('parking-penalties', [ParkingPenaltiesController::class, 'parkingPenalties'])->name('parking-penalties');
    Route::post('get-parking-penalties', [ParkingPenaltiesController::class, 'getParkingPenalties'])->name('get-parking-penalties');
    Route::post('initiate-penalty-payment', [ParkingPenaltiesController::class, 'initiateParkingPayment'])->name('initiate-penalty-payment');

    //Parking payment
    Route::post('get-parking-charges', [ParkingController::class, 'getParkingCharges'])->name('get-parking-charges');
    Route::post('initiate-onstreet-parking-payment', [ParkingController::class, 'initiateOnstreetPayment'])->name('initiate-onstreet-parking-payment');
    Route::post('initiate-offstreet-parking-payment', [ParkingController::class, 'initiateOffstreetPayment'])->name('initiate-onstreet-parking-payment');

    //Seasonal Parking
    
    //New Seasonal Parking APIS and endpoints
    Route::get('seasonal-parking', [SeasonalController::class, 'index'])->name('seasonal-parking');
    Route::post('add-seasonal-vehicle', [SeasonalController::class, 'addVehicle'])->name('add-seasonal-vehicle');
    Route::post('remove-seasonal-vehicle', [SeasonalController::class, 'removeEntry'])->name('remove-seasonal-vehicle');
    Route::post('initiate-seasonal-payment', [SeasonalController::class, 'initiatePayment'])->name('initiate-seasonal-payment');
    Route::get('get-seasonal-parking-receipt/{id}', [SeasonalController::class, 'getReceipt'])->name('get-seasonal-parking-receipt');
    Route::get('view-seasonal-parking-receipt/{id}', [SeasonalController::class, 'viewReceipt'])->name('view-seasonal-parking-receipt');

    //Seasonal parking stickers
    Route::get('seasonal-stickers/{id}', [SeasonalController::class, 'getStickers'])->name('stickers');
    Route::get('view-seasonal-stickers', [SeasonalController::class, 'viewStickers'])->name('view-seasonal-stickers');
    Route::post('print-stickers', [SeasonalController::class, 'printStickers'])->name('print-stickers');

        
    //Parking penalties
    Route::get('parking-penalties', [ParkingPenaltiesController::class ,'parkingPenalties'])->name('parking-penalties');
    Route::post('get-parking-penalties', [ParkingPenaltiesController::class ,'getParkingPenalties'])->name('get-parking-penalties');
    Route::post('initiate-penalty-payment', [ParkingPenaltiesController::class ,'initiateParkingPayment'])->name('initiate-penalty-payment');

    //PARKING

    //TRADE
    //SBP
    Route::get('renew-business-permit', [SBPController::class,'renewBusinessPermit'])->name('renew-business-permit');
    Route::post('renew-permit', [SBPController::class,'renewPermit'])->name('renew-permit');
    Route::post('get-business-details', [SBPController::class,'getBusinessDetails'])->name('get-business-details');
    Route::get('print-permit', [SBPController::class,'printPermit'])->name('print-permit');
    Route::post('get-sbp', [SBPController::class,'getSBP'])->name('get-sbp');
    Route::get('business-permit', [SBPController::class,'businessPermit'])->name('business-permit');
    Route::get('register-business', [SBPController::class,'registerBusinessForm'])->name('register-business');
    Route::post('get-wards', [SBPController::class,'getWards'])->name('get-wards');
    Route::post('print-receipt', [SBPController::class,'printReceipt'])->name('print-receipt');

    //RevenueSure Register Trade
    // Route::post('apply-new-permit', [SBPController::class,'registerBusiness'])->name('apply-new-permit');
    Route::post('register-trade-license', [SBPController::class,'registerTradeLicense'])->name('register-trade-license');
    Route::post('get-receipt-details', [ReceiptController::class, 'getReceiptDetails'])->name('get-receipt-details');

    Route::post('get-postal-name/{id}', [SBPController::class,'getPostalName'])->name('get-postal-name');
    Route::get('get-activity-detail/{id}', [SBPController::class,'getActivityDetail'])->name('get-activity-detail');
    Route::get('store-business', [SBPController::class,'storeBusiness'])->name('store-business');
    Route::post('pay-sbp', [SBPController::class,'payment'])->name('pay-sbp');
    Route::get('confirm-sbp-details', [SBPController::class,'confirmDetails'])->name('confirm-sbp-details');
    Route::get('get-permit', [SBPController::class,'getPermit'])->name('get-permit');
    Route::get('get-permit-form', [SBPController::class,'getPermitForm'])->name('get-permit-form');
    Route::get('view-sbp-permit/{id}/{business_id}', [SBPController::class,'viewPermit'])->name('view-sbp-permit');
    Route::get('get-sbp-charges/{id}', [SBPController::class,'getSBPcharges'])->name('get-sbp-charges');
    Route::post('update-business', [SBPController::class,'update'])->name('update-business');
    Route::post('renew-business', [SBPController::class,'renew'])->name('renew-business');
    Route::get('get-sbp-receipt/{id}', [SBPController::class,'getReceipt'])->name('get-sbp-receipt');
    Route::get('view-sbp-receipt/{id}', [SBPController::class,'viewReceipt'])->name('view-sbp-receipt');
    Route::post('bill-payment', [SBPController::class,'billPayment'])->name('bill-payment');
    Route::get('get-overall-receipt/{id}', [SBPController::class,'getOverallReceipt'])->name('get-overall-receipt');
    Route::get('all-printables/{id}', [SBPController::class,'allPrints'])->name('all-printables');

    Route::get('print-sbp-bill/{bill_number}', [SBPController::class,'printBill'])->name('print-sbp-bill');
    Route::get('print-trade-bill/{id}', [SBPController::class,'printTradeBill'])->name('print-trade-bill');
    //TRADE



    //DOCUMENTS
    //Receipt routes
    Route::post('generate-receipt', [ReceiptController::class, 'generateReceipt'])->name('generate-receipt');
    Route::get('get-receipt/{id}', [ReceiptController::class, 'getReceipt'])->name('get-receipt');
    Route::get('view-receipt/{id}', [ReceiptController::class, 'viewReceipt'])->name('view-receipt');
    Route::get('print-receipt/{id}', [ReceiptController::class, 'printReceipt'])->name('print-receipt');
    Route::get('download-receipt/{ref_no}', [ReceiptController::class, 'downloadReceipt'])->name('download-receipt');
    Route::post('get-receipt-details', [ReceiptController::class, 'getReceiptDetails'])->name('get-receipt-details');
    Route::get('save-receipts/{bill_number}/{user_id}', [ReceiptController::class, 'saveReceipts'])->name('save-receipts');

    // Bill Routes
    //Create a bill
    Route::get('create-bill', [BillsController::class, 'createBill'])->name('create-bill');
    Route::post('generate-bill', [BillsController::class, 'generateBill'])->name('generate-bill');

    //Pay a bill
    Route::post('get-bill-details', [BillsController::class, 'getBillDetails'])->name('get-bill-details');
    Route::get('pay-bill', [BillsController::class, 'payBill'])->name('pay-bill');
    Route::post('initiate-bill-payment', [BillsController::class, 'initiateBillPayment'])->name('initiate-bill-payment');
    Route::get('get-bill-receipt/{id}', [BillsController::class, 'getBillReceipt'])->name('get-bill-receipt');
    Route::get('view-bill-receipt/{id}', [BillsController::class, 'viewBillReceipt'])->name('view-bill-receipt');
    Route::get('print-bill/{bill_number}', [BillsController::class, 'printBill'])->name('print-bill');
    //DOCUMENTS
});