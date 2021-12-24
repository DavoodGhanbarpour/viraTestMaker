<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\AssignClassController;
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
Route::get('/', [ AthenticationController::class, 'index' ]);
Route::get('/login', [ AthenticationController::class, 'index' ])->name('login');
Route::get('/logout', [ AthenticationController::class, 'logout' ])->name('logout');
Route::post('/authenticate', [ AthenticationController::class, 'authenticate' ])->name('authenticate');

Route::middleware(['auth'])->group(function () {

    
    /**
     * Main
     */
    Route::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');
    Route::get('/profile', [ UserController::class, 'profile' ])->name('profile');
    Route::post('/profile/update', [ UserController::class, 'updateProfile' ])->name('updateProfile');
   


    /**
     * Courses
     */
    Route::get('/courses', [ CourseController::class, 'index' ])->name('courses');
    Route::middleware(['godUsers'])->group(function () {
        Route::get('/course/add', [ CourseController::class, 'addCourse' ])->name('addCourse');
        Route::get('/course/edit/{id}', [ CourseController::class, 'editCourse' ])->name('editCourse');
        Route::get('/course/delete/{id}', [ CourseController::class, 'deleteCourse' ])->name('deleteCourse');
        Route::post('/course/insert', [ CourseController::class, 'insertCourse' ])->name('insertCourse');
        Route::post('/course/update/{id}', [ CourseController::class, 'updateCourse' ])->name('updateCourse');



    /**
     * Categories
     */

        Route::get('/categories', [ CategoryController::class, 'index' ])->name('categories');
        Route::get('/category/add', [ CategoryController::class, 'addCategory' ])->name('addCategory');
        Route::get('/category/edit/{id}', [ CategoryController::class, 'editCategory' ])->name('editCategory');
        Route::get('/category/delete/{id}', [ CategoryController::class, 'deleteCategory' ])->name('deleteCategory');
        Route::post('/category/insert', [ CategoryController::class, 'insertCategory' ])->name('insertCategory');
        Route::post('/category/update/{id}', [ CategoryController::class, 'updateCategory' ])->name('updateCategory');


    
    /**
     * Classes
     */

        Route::get('/classes', [ ClassController::class, 'index' ])->name('categories');
        Route::get('/class/add', [ ClassController::class, 'addClass' ])->name('addClass');
        Route::get('/class/edit/{id}', [ ClassController::class, 'editClass' ])->name('editClass');
        Route::get('/class/delete/{id}', [ ClassController::class, 'deleteClass' ])->name('deleteClass');
        Route::post('/class/insert', [ ClassController::class, 'insertClass' ])->name('insertClass');
        Route::post('/class/update/{id}', [ ClassController::class, 'updateClass' ])->name('updateClass');
    

    /**
     * Semesters
    */

        Route::get('/semesters', [ SemesterController::class, 'index' ])->name('semesters');
        Route::get('/semester/add', [ SemesterController::class, 'addSemester' ])->name('addSemester');
        Route::get('/semester/edit/{id}', [ SemesterController::class, 'editSemester' ])->name('editSemester');
        Route::get('/semester/delete/{id}', [ SemesterController::class, 'deleteSemester' ])->name('deleteClass');
        Route::post('/semester/insert', [ SemesterController::class, 'insertSemester' ])->name('insertSemester');
        Route::post('/semester/update/{id}', [ SemesterController::class, 'updateSemester' ])->name('updateSemester');
        Route::get('/semester/activate/{id}', [ SemesterController::class, 'activateSemester' ])->name('activateSemester');





    /**
     * Assignees
    */

        Route::get('/assignees', [ AssignClassController::class, 'index' ])->name('assignees');
        Route::get('/assign/edit/{id}', [ AssignClassController::class, 'editAssignee' ])->name('editAssignee');
        Route::post('/assign/update/{id}', [ AssignClassController::class, 'updateAssignee' ])->name('updateAssignee');
        Route::get('/assignees/class/{classID}', [ AssignClassController::class, 'classAssignees' ])->name('classAssignees');
    });

    
    /**
     * Admin 
     */
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [ UserController::class, 'users' ])->name('users');
        Route::get('/user/edit/{id}', [ UserController::class, 'editUser' ])->name('editUser');
        Route::get('/user/delete/{id}', [ UserController::class, 'deleteUser' ])->name('deleteUser');
        Route::post('/user/update/{id}', [ UserController::class, 'updateUser' ])->name('updateUser');
    });

   

    
});