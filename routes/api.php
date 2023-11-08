<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::resource('investor_detail', App\Http\Controllers\API\InvestorDetailController::class);
Route::resource('comments', App\Http\Controllers\API\CommentController::class);
Route::resource('agric_business_detail', App\Http\Controllers\API\AgricBusinessController::class);
Route::resource('user', App\Http\Controllers\API\UserApiController::class);
Route::get('user/phone_exist/{id}', [App\Http\Controllers\API\UserApiController::class,'phone_exist']);
Route::get('user/email_exist/{id}', [App\Http\Controllers\API\UserApiController::class,'email_exist']);
Route::get('comments/{user_id}/{investor_id}', [App\Http\Controllers\API\CommentController::class,'chat']);
Route::get('dashboard', [App\Http\Controllers\API\DashboardController::class,'index']);