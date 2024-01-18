<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//********************* */ AuthenMobile  ***********************************
Route::get('/test',function(Request $request){
    return 'Authenticated';
});

Route::match(['get','post'],'getmobile',[App\Http\Controllers\AuthenmobileController::class, 'getmobile'])->name('mo.getmobile');//
Route::match(['get','post'],'getmobile_api',[App\Http\Controllers\AuthenmobileController::class, 'getmobile_api'])->name('mo.getmobile_api');//

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('authencode', [App\Http\Controllers\AuthencodeController::class, 'authencode'])->name('authencode');

Route::get('smartcard_readonly', [App\Http\Controllers\ApiController::class, 'smartcard_readonly'])->name('smartcard_readonly');
Route::get('patient_readonly', [App\Http\Controllers\ApiController::class, 'patient_readonly'])->name('patient_readonly');
Route::get('ovst_key', [App\Http\Controllers\ApiController::class, 'ovst_key'])->name('ovst_key');

Route::get('home_rpst', [App\Http\Controllers\ApiController::class, 'home_rpst'])->name('home_rpst');

Route::get('pimc', [App\Http\Controllers\ApiController::class, 'pimc'])->name('pimc');
Route::get('adp', [App\Http\Controllers\ApiController::class, 'adp'])->name('adp');
Route::get('ucep', [App\Http\Controllers\ApiController::class, 'ucep'])->name('ucep');