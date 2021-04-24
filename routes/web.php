<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\DroneManageController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MissionController;


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

Route::get('/intro', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('users', UserManageController::class);
Route::resource('drone', DroneManageController::class);
Route::get('/user/username={name} pw={pw}',[UserInfoController::class, 'self']);
// Route::get('/user_info', [UserInfoController::class, 'index'])->middleware('auth');

Route::get('/mission', [MissionController::class, 'index'])->middleware('auth');
Route::get('/mission/{id}', [MissionController::class, 'show']);

Route::get('/missionGet_token={pw}%status={code}', );

Route::get('/dv', function() {
    return view('datavisualization');
});

Route::get('/mission_count', [MissionController::class, 'getMissionCount'])->name('mission_count');

Route::get('/mitt', [MissionController::class, 'test'])->name('test');
