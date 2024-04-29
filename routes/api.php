<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(ApiController::class)->group(function () {
    Route::get("estates", "all_estates");
    Route::get("estate/{id}", "estate");
    Route::middleware(["auth:sanctum"])->group(function () {
        Route::get("myInformation", "myInfo");
        Route::post("reservation/{id}", "realEstate_reservation");
        Route::post("reserveCancel/{id}", "reservation_cancel");
        Route::get("reservations", "all_reservations");
        Route::post("createContract", "create_contract");
        Route::get("contracts", "all_contracts");
        Route::get("earlyDelivery/{id}", "early_delivery");
        Route::get("extension/{id}", "contract_extension");
    });
});


Route::controller(AuthController::class)->group(function () {
    Route::middleware(["auth:sanctum"])->group(function () {
        Route::get("logout", "logout");
        Route::post("change_password", "changePasswordWithAuth");
        Route::get("deleteAccount", "delete_account");
    });
    Route::prefix("auth")->group(function () {
        Route::post("register", "register");
        Route::post("login", "login");
        Route::post("forgetPassword", "forget_password");
        Route::post("checkCode", "code_validation");
        Route::post("changePassword", "change_password");
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
