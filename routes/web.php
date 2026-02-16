<?php

use App\Http\Controllers\Activity;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Login;
use App\Http\Controllers\Register;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LessonAdmin;
use App\Http\Controllers\Users;
use App\Http\Controllers\ProfileAdmin;
use App\Http\Controllers\RequestAdmin;
use App\Http\Controllers\StudentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'revalidate'], function () {
    Route::get('/login', [Login::class, 'index'])->name('login');
    Route::post('/prosesLogin', [Login::class, 'prosesLogin'])->middleware('throttle:10,1');
    Route::post('/prosesRegister', [Login::class, 'prosesRegister']);
    Route::post('/prosesLoginStudent', [Login::class, 'prosesLoginStudent'])->middleware('throttle:10,1');
    Route::post('/logout', [Login::class, 'logout'])->name('logout');
    Route::get('/lesson/{lesson}', [FrontendController::class, 'lesson'])->name('lesson.show');

    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/category-lesson/{category}', [FrontendController::class, 'category'])->name('category.show');

    Route::middleware('student')->group(function () {
        Route::post('/logout-student', [Login::class, 'logoutStudent'])->name('student.logout');
        
        Route::post('/lesson/{lesson}', [FrontendController::class, 'storeFeedback'])->name('lesson.feedback');
        Route::post('/lesson/{lesson}/add', [FrontendController::class, 'addLesson'])->name('lesson.add');
        Route::post('/request', [FrontendController::class, 'storeRequest'])->name('lesson.request');
        Route::get('/request-status', [FrontendController::class, 'requestStatus'])->name('request.status');

        Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');
        Route::get('/edit-profile', [FrontendController::class, 'editProfile'])->name('profile.edit');
        Route::patch('/profile', [FrontendController::class, 'updateProfile'])->name('profile.update');
        Route::delete('/destroy-profile', [FrontendController::class, 'destroyProfile'])->name('profile.destroy');

        Route::get('/my-learning', [FrontendController::class, 'myLearning'])->name('mylearning');
        Route::get('/notifications', [FrontendController::class, 'notifications'])->name('notifications');
    });

    Route::group(['middleware' => 'admin'], function () {
        // Dashboard
        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    
        // User Manage
        Route::get('/user-manage', [Users::class, 'index'])->name('user-manage');
    
        // REGISTER
        Route::get('/register', [Register::class, 'index'])->name('register');
        Route::post('/register', [Register::class, 'prosesRegister']);
    
        // Profile Admin
        Route::get('/profile-admin/{id}', [ProfileAdmin::class, 'index']);
        Route::get('/update-profile-admin/{id}', [ProfileAdmin::class, 'updateProfile']);
        Route::post('/update-profile-admin/{id}', [ProfileAdmin::class, 'update']);
        Route::get('/change-status-admin/{id}', [ProfileAdmin::class, 'changeStatus']);
        Route::get('/change-password', [ProfileAdmin::class, 'changePassword']);
        Route::post('/change-password/{id}', [ProfileAdmin::class, 'updatePassword']);
    
        // Category Routes
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/category/create', [CategoryController::class, 'create']);
        Route::post('/category/store', [CategoryController::class, 'store']);
        Route::get('/category/{id}', [CategoryController::class, 'show']);
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/category/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    
        Route::get('/activity', [Activity::class, 'index']);
    
        Route::get('/lesson-admin', [LessonAdmin::class, 'index'])->name('admin.lesson.index');
        Route::get('/lesson-admin/create', [LessonAdmin::class, 'create'])->name('admin.lesson.create');
        Route::get('/lesson-admin/roadmap/{category}', [LessonAdmin::class, 'roadmap'])->name('admin.lesson.roadmap');
        Route::post('/lesson-admin', [LessonAdmin::class, 'store'])->name('admin.lesson.store');
        Route::get('/lesson-admin/{lesson}', [LessonAdmin::class, 'show'])->name('admin.lesson.show');
        Route::get('/lesson-admin/{lesson}/edit', [LessonAdmin::class, 'edit'])->name('admin.lesson.edit');
        Route::patch('/lesson-admin/{lesson}', [LessonAdmin::class, 'update'])->name('admin.lesson.update');
        Route::patch('/lesson-admin/{lesson}/remove-category', [LessonAdmin::class, 'removeCategory'])->name('admin.lesson.removeCategory');
        Route::delete('/lesson-admin/{lesson}', [LessonAdmin::class, 'destroy'])->name('admin.lesson.destroy');
        Route::get('lesson-admin/roadmap/{category?}', [LessonAdmin::class, 'roadmap'])->name('admin.lesson.roadmap');

        Route::get('/request-admin', [RequestAdmin::class, 'index'])->name('admin.request.index');
        Route::post('/request-admin/{data}/respond', [RequestAdmin::class, 'respond'])->name('admin.request.respond');
        Route::post('/request-admin/{data}/decline', [RequestAdmin::class, 'decline'])->name('admin.request.decline');
        
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');

        
    });
});
