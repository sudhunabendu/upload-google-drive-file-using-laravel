<?php

use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\GoogleDriveController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('google/login',[GoogleDriveController::class,'googleLogin'])->name('google.login');
Route::get('google-drive/file-upload',[GoogleDriveController::class,'googleDriveFilePpload'])->name('google.drive.file.upload');

Route::post('/',[IndexController::class,'uploadFileToDrive']);