<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\AssignClassController;
use App\Http\Controllers\ExamController;
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
Route::post('/authenticate', [ AthenticationController::class, 'authenticate' ])->name('authenticate');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [ AthenticationController::class, 'logout' ])->name('logout');

    /**
     * Main
     */
    Route::get('/dashboard', [ DashboardController::class, 'index' ])->name('dashboard');
    Route::get('/profile', [ UserController::class, 'profile' ])->name('profile');
    Route::post('/profile/update', [ UserController::class, 'updateProfile' ])->name('updateProfile');



    /**
     * General Parts
     */
    Route::get('/courses', [ CourseController::class, 'index' ])->name('courses');
    Route::get('/exams/{id}', [ ExamController::class, 'examsOfAClass' ])->name('examsOfACourse');
    Route::get('/exam/result/{examID}/{studentID?}', [ ExamController::class, 'showResultOfExam' ])->name('examResult');
    Route::get('/attendance/{examID}', [ ExamController::class, 'attendance' ])->name('attendance');
    Route::get('/attendance/{examID}/{questionID}', [ ExamController::class, 'attendance' ])->name('attendanceWithQuestion');
    Route::post('/attendance/answer/{questionID}/{moveType?}', [ ExamController::class, 'updateExamQuestionResult' ])->name('updateExamQuestion');

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
     * Tickets
     */

        Route::get('/tickets', [ ClassController::class, 'index' ])->name('classes');

    /**
     * Classes
     */

        Route::get('/classes', [ ClassController::class, 'index' ])->name('classes');
        Route::get('/class/add', [ ClassController::class, 'addClass' ])->name('addClass');
        Route::get('/class/edit/{id}', [ ClassController::class, 'editClass' ])->name('editClass');
        Route::get('/class/delete/{id}', [ ClassController::class, 'deleteClass' ])->name('deleteClass');
        Route::post('/class/insert', [ ClassController::class, 'insertClass' ])->name('insertClass');
        Route::post('/class/update/{id}', [ ClassController::class, 'updateClass' ])->name('updateClass');



    /**
     * Exams
     */

        Route::get('/exams', [ ExamController::class, 'index' ])->name('exams');
        Route::get('/exam/scores/{examID}', [ ExamController::class, 'examsScoresByStudent' ])->name('examsScoresByStudent');
        Route::get('/exam/add', [ ExamController::class, 'addExam' ])->name('addExam');
        Route::get('/exam/score/{examID}/{studentID}', [ ExamController::class, 'addScore' ])->name('addScore');
        Route::get('/exam/questions/{id}', [ ExamController::class, 'addQuestions' ])->name('addQuestions');
        Route::get('/exam/edit/{id}', [ ExamController::class, 'editExam' ])->name('editExam');
        Route::get('/exam/delete/{id}', [ ExamController::class, 'deleteExam' ])->name('deleteExam');
        Route::post('/exam/insert', [ ExamController::class, 'insertExam' ])->name('insertExam');
        Route::post('/exam/insertQuestions/{id}', [ ExamController::class, 'insertQuestions' ])->name('insertQuestions');
        Route::post('/exam/score/insertScore/{examID}/{studentID}', [ ExamController::class, 'insertScore' ])->name('insertScore');
        Route::post('/exam/update/{id}', [ ExamController::class, 'updateExam' ])->name('updateExam');



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
        Route::get('/user/add', [ UserController::class, 'addUser' ])->name('addUser');
        Route::post('/user/insert', [ UserController::class, 'insertUser' ])->name('insertUser');
        Route::get('/user/edit/{id}', [ UserController::class, 'editUser' ])->name('editUser');
        Route::get('/user/delete/{id}', [ UserController::class, 'deleteUser' ])->name('deleteUser');
        Route::post('/user/update/{id}', [ UserController::class, 'updateUser' ])->name('updateUser');
    });




});
