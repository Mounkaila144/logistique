<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CamionsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DonnesController;
use App\Http\Controllers\PayementsController;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client as TwilioClient;


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

Auth::routes();
//Language Translation

//ajouter une condition si l'utilisateur est connecté ou non
// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang'])->middleware('auth');
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashbord'])->name('dashbord')->middleware('auth');

Route::resource('clients', ClientsController::class)->names([
    'index' => 'clients.index',
    'create' => 'clients.create',
    'store' => 'clients.store',
    'edit' => 'clients.edit',
    'update' => 'clients.update',
    'destroy' => 'clients.destroy',
])->middleware('auth');;
//route pour le remboursement
Route::post('remboursement/{id}', [App\Http\Controllers\PayementsController::class, 'remboursement'])->name('remboursement')->middleware('auth');;
Route::get('download/{id}', [App\Http\Controllers\PayementsController::class, 'download'])->name('download')->middleware('auth');;

Route::resource('payements', PayementsController::class)->names([
    'index' => 'payements.index',
    'create' => 'payements.create',
    'store' => 'payements.store',
    'edit' => 'payements.edit',
    'update' => 'payements.update',
    'destroy' => 'payements.destroy',
])->middleware('auth');;
Route::resource('articles', ArticlesController::class)->names([
    'index' => 'articles.index',
    'create' => 'articles.create',
    'store' => 'articles.store',
    'edit' => 'articles.edit',
    'update' => 'articles.update',
    'destroy' => 'articles.destroy',
])->middleware('auth');;


Route::resource('camions', CamionsController::class)->names([
    'index' => 'camions.index',
    'create' => 'camions.create',
    'store' => 'camions.store',
    'edit' => 'camions.edit',
    'update' => 'camions.update',
    'destroy' => 'camions.destroy',
])->middleware('auth');;
//route pour le remboursement
Route::post('remboursement/camion/{id}', [App\Http\Controllers\DonnesController::class, 'remboursement'])->name('remboursement-camion')->middleware('auth');;
Route::get('download/caamion/{id}', [App\Http\Controllers\DonnesController::class, 'download'])->name('download-camion')->middleware('auth');;

Route::resource('donnes', DonnesController::class)->names([
    'index' => 'donnes.index',
    'create' => 'donnes.create',
    'store' => 'donnes.store',
    'edit' => 'donnes.edit',
    'update' => 'donnes.update',
    'destroy' => 'donnes.destroy',
])->middleware('auth');;
Route::post('/notifications/mark-all-as-read',[ClientsController::class,"markAllAsRead"] )->name('notifications.markAllAsRead');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

