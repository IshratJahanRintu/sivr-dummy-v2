<?php

use App\Http\Controllers\SivrPageController;
use App\Http\Controllers\SivrPageControllerApi;
use App\Http\Controllers\SivrPageElementControllerApi;
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
//Routes for sivr pages
Route::get('/root-sivr-page/{vivrId}', [SivrPageControllerApi::class,'getRootPage']);
Route::get('/sivr-pages/{vivrId}', [SivrPageControllerApi::class,'getAllPages']);
Route::post('/add-sivr-page',[SivrPageControllerApi::class,'store']);
Route::post('/update-sivr-page/{pageId}',[SivrPageControllerApi::class,'update']);
Route::post('/delete-sivr-page/{pageId}',[SivrPageControllerApi::class,'destroy']);
Route::post('/upload-audio',[SivrPageControllerApi::class,'saveAudio']);

//Routes for page element

Route::post('/delete-page-element/{elementId}',[SivrPageElementControllerApi::class,'destroy']);
Route::post('/add-page-element',[SivrPageElementControllerApi::class,'store']);
