<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'loginForm'])->name("loginForm");
Route::post('/mylogin', [App\Http\Controllers\Auth\LoginController::class, 'mylogin'])->name("mylogin");
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Auth::routes([
    'register' => false,
    'verify' => false,
    'reset'=>false
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    // Route::get("/dashboard",[App\Http\Controllers\DashboardController::class,'index'])->name("dashboard");
    Route::resource("ledgers",App\Http\Controllers\LedgerController::class);
    Route::get("/users/{id}/profile",[App\Http\Controllers\UserController::class,'profile'])->name("users.profile");
    Route::get("/print",[App\Http\Controllers\LedgerController::class,'print'])->name("print.daily");
    Route::get("monthly_report",[App\Http\Controllers\LedgerController::class,'monthReport'])->name("monthly.report");
});
Route::middleware(['admin'])->group(function () {
    Route::resource("users",App\Http\Controllers\UserController::class);
    Route::resource("categories",App\Http\Controllers\CategoryController::class);
    Route::post("/users/addMoney",[App\Http\Controllers\UserController::class,'addMoney'])->name("addMoney");
});

Route::get('/hello', function () {
   return view("ledger.print");
});
