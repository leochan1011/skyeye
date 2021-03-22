<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\mission\GetMissionController;
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


Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('users', UserManageController::class);
Route::get('/user/username={name} pw={pw}',[UserInfoController::class, 'self']);
// Route::get('/user_info', [UserInfoController::class, 'index'])->middleware('auth');

Route::get('/mission', [MissionController::class, 'index'])->middleware('auth');
Route::get('/mission/{id}', [MissionController::class, 'show']);

Route::get('/missionGet_token={pw}%status={code}', [GetMissionController::class, 'get']);