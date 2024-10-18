<?php

use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MesReservationController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SaisonController;
use App\Http\Controllers\VoitureController;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Voiture;
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

/* Route::get('/admin', function () {
    $reservations = Reservation::all();
    return view('admin', ['reservations'=>$reservations]);
})->middleware('adminAuth')->name('admin');
 */


Route::get('/home', function () {
    $client = Client::find(session('client_id'));
    return view('home', compact('client'));
})->name('home');

Route::get('/', function () {
    $voitures = Voiture::all();
    return view('welcome', compact('voitures'));
})->name('welcome');

Route::get('/all', function () {
    $voitures = Voiture::all();
    return view('all', compact('voitures'));
})->name('all');

Route::get('/showcar', function () {
    return view('showcar');
})->name('showcar');

Route::get('/myres', [MesReservationController::class, 'index'])->name('myres');
Route::post('/myres/cancel/{id}', [MesReservationController::class, 'cancel'])->name('myrescancel');

Route::resource('/cars', CarController::class);
Route::post('/cars/find', [CarController::class, 'find'])->name('cars.find');
Route::post('/payment', [CarController::class, 'payment'])->middleware('clientAuth')->name('payment');
Route::get('/payment', function(){
    return redirect()->route('welcome');
});

Route::resource('/voitures', VoitureController::class)->middleware('adminAuth');
Route::post('/voitures/search', [VoitureController::class, 'search'])->name('voitures.search');
Route::post('/voitures/find', [VoitureController::class, 'find'])->name('voitures.find');
//Route::get('/payment', [VoitureController::class, 'payment'])->middleware('auth')->name('payment');

Route::resource('/saisons', SaisonController::class)->middleware('adminAuth');

//Route::get('/calendrier', [CalendrierController::class, 'index'])->middleware('adminAuth')->name('calendrier.index');
Route::get('/calendrier', [CalendrierController::class, 'index'])->middleware('adminAuth');

Route::resource('/charges', ChargeController::class)->middleware('adminAuth');

Route::resource('/bilan', BilanController::class)->middleware('adminAuth');

Route::resource('/prices', PriceController::class);

Route::resource('/clients', ClientController::class)->middleware('adminAuth');

Route::resource('/admins', AdminController::class)->middleware('adminAuth');

Route::resource('/accessoires', AccessoireController::class)->middleware('adminAuth');

Route::resource('/reservations', ReservationController::class);

//Route::post('/reservations/result', [ReservationController::class, 'result'])->name('reservations.result');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/adminlogin', [AdminAuthController::class, 'loginForm'])->name('adminLogin');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/adminlogin', [AdminAuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/adminlogout', [AdminAuthController::class, 'logout'])->name('adminLogout');

