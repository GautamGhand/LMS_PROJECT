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
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\CourseStatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordSetController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserStatusController;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
});

Route::get('/', function () {

    if(Auth::check())
    {
        if(Auth::user()->is_employee)
        {
            return redirect()->route('employee');
        }
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/forgot-password', [ForgotPasswordController::class,'index'])->name('forgotpassword.index');

Route::post('/forgot-password', [ForgotPasswordController::class,'confirmation'])->name('forgotpassword.mail');

Route::get('/forgot-password/{user:slug}/edit', [ForgotPasswordController::class,'edit'])->name('forgotpassword.edit');

Route::post('/forgot-password/{user}/update', [ForgotPasswordController::class,'update'])->name('forgotpassword.update');

Route::middleware(['auth'])->group(function()
{

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/employee', [EmployeeController::class,'index'])->name('employee');

Route::controller(UserController::class)->group(function()
{
    Route::get('/users','index')->name('users.index');

    Route::get('/users/create','create')->name('users.create');

    Route::post('/users/store','store')->name('users.store');

    Route::get('/users/{user:slug}/edit','edit')->name('users.edit');

    Route::post('/users/{user}/update','update')->name('users.update');

    Route::delete('/users/{user}delete','delete')->name('users.delete');
});

Route::post('users/{user}/active', [UserStatusController::class, 'status'])->name('users.active');

Route::controller(CategoryController::class)->group(function()
{

    Route::get('categories','index')->name('categories.index');

    Route::get('/categories/create','create')->name('categories.create');

    Route::post('/categories/store','store')->name('categories.store');

    Route::get('/categories/{category:slug}/edit','edit')->name('categories.edit');

    Route::post('/categories/{category}/update','update')->name('categories.update');

    Route::delete('/categories/{category}/delete','destroy')->name('categories.delete');


});

Route::post('categories/{category}/active', [CategoryStatusController::class, 'status'])->name('categories.active');


Route::controller(CourseController::class)->group(function()
{

    Route::get('/courses','index')->name('courses.index');

    Route::get('/courses/create','create')->name('courses.create');

    Route::post('/courses/store','store')->name('courses.store');

    Route::get('/courses/{course:slug}','show')->name('courses.show');

    Route::get('/courses/edit/{course:slug}','edit')->name('courses.edit');

    Route::post('/courses/update/{course}','update')->name('courses.update');


});

Route::get('/projects', [ProjectController::class,'index']);

Route::get('/courses/{course:slug}/active', [CourseStatusController::class, 'status'])->name('courses.status');


Route::controller(UnitController::class)->group(function()
{
    
    Route::get('/courses/{course:slug}/units/create','create')->name('units.create');

    Route::post('courses/{course}/units/store','store')->name('units.store');

    Route::get('courses/{course:slug}/units/{unit:slug}/edit','edit')->name('units.edit');

    Route::post('/courses/{course}/units/update/{unit}','update')->name('units.update');

    Route::delete('/courses/{unit:slug}/units/delete','delete')->name('units.delete');

});

Route::get('/courses/{course:slug}/enrolled', [EnrollmentController::class,'index'])->name('enrolled.index');

Route::post('/courses/{course}/enrolled', [EnrollmentController::class,'store'])->name('enrolled.store');

Route::delete('/courses/{course}/{user}/delete', [EnrollmentController::class,'delete'])->name('enrolled.delete');


Route::get('/users/{user:slug}/courses', [CourseEnrollmentController::class,'index'])->name('courseenrolled.index');

Route::post('/users/{user}/courses', [CourseEnrollmentController::class,'store'])->name('courseenrolled.store');

Route::delete('/users/{user}/{course}/delete', [CourseEnrollmentController::class,'delete'])->name('courseenrolled.delete');

});

Route::get('/set-password/{user:slug}', [PasswordSetController::class, 'index'])->name('setpassword.index');

Route::post('/set-password/{user}', [PasswordSetController::class, 'setpassword'])->name('setpassword');

Route::get('/reset-password/{user:slug}', [ResetPasswordController::class,'index'])->name('resetpassword.index');

Route::post('/reset-password/{user}', [ResetPasswordController::class, 'updatePassword'])->name('resetpassword');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');




