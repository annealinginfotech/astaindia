<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Courses\BaseCourseController;
use App\Http\Controllers\Courses\MainCourseController;
use App\Http\Controllers\Fees\FeesStructureController;
use App\Http\Controllers\Roles_And_Permissions\RolesController;
use App\Http\Controllers\Roles_And_Permissions\PermissionsController;


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

Route::get('/', function () {
    return view('index');
})->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login-operation');

Route::middleware(['auth'])->group(function() {
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');


    Route::resource('users', UserController::class);
    Route::post('users/block', [UserController::class, 'block'])->name('users.block');
    Route::post('users/unblock', [UserController::class, 'unblock'])->name('users.unblock');

    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);

    /* ============= Course routing ============ */
    Route::resource('base-course', BaseCourseController::class);
    Route::get('base-course/get-main-courses/{id}', [BaseCourseController::class, 'getMainCourse'])->name('base-course.get-main-courses');
    Route::resource('main-course', MainCourseController::class);

    /* ======== Fees strucure routing ========== */
    Route::resource('fees-structure', FeesStructureController::class);
});
