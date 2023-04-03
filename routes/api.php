<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HackernewsController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([],function(){
    Route::get('/stories',[HackernewsController::class,'indexStories']);
    Route::get('/stories/{id}',[HackernewsController::class,'fetchById']);
});
// fix the cron job
// fix the issue on parent_id
//fix the issue on user

