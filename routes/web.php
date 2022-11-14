<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\CategoryStatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordSetController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserStatusController;
use App\Notifications\ResetPasswordNotification;

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
});

Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::get('/login', function () {
    return view('login');
})->name('login.index');

Route::post('/login',[LoginController::class,'login'])->name('login');

Route::middleware(['auth'])->group(function()
{

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/employee', [DashboardController::class,'employee'])->name('employee');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('/users/{user:slug}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::post('/users/{user}/update', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{user}delete', [UserController::class, 'delete'])->name('users.delete');

Route::post('users/{user}/{status}/active',[UserStatusController::class,'status'])->name('users.active');

Route::get('categories',[CategoryController::class,'index'])->name('categories.index');

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

Route::post('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

Route::post('categories/{category}/{status}/active',[CategoryStatusController::class,'status'])->name('categories.active');

});

Route::get('/set-password/{user:slug}', [PasswordSetController::class, 'index'])->name('setpassword.index');

Route::post('/set-password/{user}', [PasswordSetController::class, 'setpassword'])->name('setpassword');

Route::get('/reset-password/{user:slug}', [ResetPasswordController::class,'index'])->name('resetpassword.index');

Route::post('/reset-password/{user}', [ResetPasswordController::class, 'updatePassword'])->name('resetpassword');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

