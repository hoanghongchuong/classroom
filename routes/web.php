<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::prefix('admin')->group(function() {
//    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
//});

Route::view('/exam-page', 'exam-page');
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('test-redis', function() {
//    Redis::set('test-123', 'xin chao');

    $data = Cache::remember('all_class', 60, function() {
        return Classes::all();
    });
//    Cache::store('redis')->put('laradock', 'awesome', 100);
    $viewData = [
      'data' => $data
    ];
    return view('exam-page', $viewData);
});


Route::get('send-mail', [\App\Http\Controllers\TestController::class, 'sendMail']);


