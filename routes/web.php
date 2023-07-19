<?php

use App\Http\Controllers\SivrPageController;
use App\Http\Controllers\SivrPageElementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\SocialPlatformController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WebHookController;

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
    return view('auth.login');
});

Route::post('login', AuthController::class);
Route::resource('users', UserController::class);
Route::get('logout', [UserController::class, 'logout']);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('agent', AgentController::class);
Route::resource('social-platform', SocialPlatformController::class);
Route::resource('webhook-log', WebHookController::class);
Route::resource('sivr-pages', SivrPageController::class);
Route::resource('sivr-page-elements', SivrPageElementController::class);
Route::post('/sivr-pages/save-audio', [SivrPageController::class, 'saveAudio'])->name('sivr-pages.save-audio');
Route::get('fb-page-webhook', [WebHookController::class, 'webHook']);
Route::post('fb-page-webhook', [WebHookController::class, 'fbPageWebHookData']);
Route::post('instagram-webhook', [WebHookController::class, 'instagramWebHookData']);
Route::post('whatsapp-webhook', [WebHookController::class, 'whatsAppWebHookData']);

/* API */
// Route::get('api/v1/getAccount/{id}', [AccountController::class, 'getAccount']);
