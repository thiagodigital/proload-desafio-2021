<?php

use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

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
Route::get('/feed', [FeedController::class, 'createFeedEntity']);
Route::get('/feed/{feed}', [FeedController::class, 'showFeedEntity']);
Route::get('/subscriber', [FeedController::class, 'subscriberFeedList']);
Route::get('/subscriber/{id}', [FeedController::class, 'subscriberFeedEntity']);
Route::get('/feed/{subscriber}/{feed}', [FeedController::class, 'confirmFeedEntity']);
Route::get('/acesso', [FeedController::class, 'evento']);
Route::get('/', function () {
    return redirect('/admin');
});
