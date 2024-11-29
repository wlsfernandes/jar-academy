<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AccessController;


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
    return view('site.welcome');
});

Auth::routes();

Route::middleware(['auth', 'institution.scope'])->group(function () {
    // Teachers
    Route::resource('teachers', TeacherController::class)->except(['edit']);
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');

    // Students
    Route::resource('students', StudentController::class)->except(['edit']);
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');

    // Modules
    Route::resource('modules', ModuleController::class)->except(['edit']);
    Route::get('/modules/{id}/edit', [ModuleController::class, 'edit'])->name('modules.edit');

    // Courses
    Route::resource('courses', CourseController::class)->except(['edit']);
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');

    // Access
    Route::resource('access', AccessController::class)->only(['index', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
    Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');

    // Catch-all route
    Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])
         ->where('any', '.*');
});


//Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);

// Authenticated routes
