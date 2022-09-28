<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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

Route::get('/', function () {
    return view('layout');
});
Route::resource('news', NewsController::class);
Route::get('/news/{new}', [NewsController::class, 'show'])->name('news.show');

Route::get('/news/send-email/{news}', [NewsController::class, 'sendNewRecordDataViaEmail'])->name('news.email');
