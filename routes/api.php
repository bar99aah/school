<?php

use App\Http\Controllers\api\SearchController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\Dashboard\AdvertismentController;
use App\Http\Controllers\Dashboard\ClassController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\api\CourseController as apiCourseController;
use App\Http\Controllers\api\MarkController as apiMarkController;
use App\Http\Controllers\api\PlanController as apiPlanController;
use App\Http\Controllers\api\ExamController as apiExamController;
use App\Http\Controllers\Dashboard\ExamController;
use App\Http\Controllers\Dashboard\FileController;
use App\Http\Controllers\Dashboard\MarkController;
use App\Http\Controllers\Dashboard\PlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Dashboard
Route::controller(\App\Http\Controllers\Dashboard\RegisterController::class)->prefix('dashboard')->group(function (){
    //Route::post('register' , 'register') ;

    Route::post('login',  'Login');

    Route::post('logout' , 'Logout')->middleware(['auth:dashboard']) ;
});

Route::prefix('dashboard')->middleware('auth:dashboard')->group(function () {
    Route::controller(AdvertismentController::class)->group(function () {
        Route::get('advertisment/getAll', 'index');
        Route::post('advertisment/create', 'store');
        Route::post('advertisment/delete/{id}', 'destroy');
    });
    Route::controller(ClassController::class)->group(function () {
        Route::get('class/getAll', 'index');
        Route::post('class/create', 'store');
        Route::post('class/delete/{id}', 'destroy');
    });
    Route::controller(CourseController::class)->group(function () {
        Route::get('course/getAll/{class_id}', 'index');
        Route::post('course/create', 'store');
        Route::post('course/delete/{id}', 'destroy');
    });
    Route::controller(MarkController::class)->group(function () {
        Route::get('mark/getAll', 'index');
        Route::get('/user/{userId}/marks','getUserMarks');
        Route::post('mark/create', 'store');
        Route::post('mark/delete/{id}', 'destroy');
    });
    Route::controller(PlanController::class)->group(function () {
        Route::get('plan/getAll', 'index');
        Route::post('plan/create', 'store');
        Route::post('plan/delete/{id}', 'destroy');
    });
    Route::controller(ExamController::class)->group(function () {
        Route::get('exam/getAll', 'index');
        Route::post('exam/create', 'store');
        Route::post('exam/delete/{id}', 'destroy');
    });
    Route::controller(FileController::class)->group(function () {
        Route::get('file/getAll/{course_id}', 'index');
        Route::post('file/create', 'store');
        Route::post('file/delete/{id}', 'destroy');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('getAllUsers', 'getAllUsers');
    });
});

//API
Route::controller(\App\Http\Controllers\api\RegisterController::class)->group(function (){
    Route::post('register' , 'register') ;

    Route::post('login',  'Login');

    Route::post('logout' , 'Logout')->middleware(['auth:api']) ;
    Route::controller(ClassController::class)->group(function () {
        Route::get('class/getAll', 'index');
    });
    Route::prefix('app')->middleware('auth:api')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('profile', 'profile');
        });

        Route::controller(AdvertismentController::class)->group(function () {
            Route::get('advertisment/getAll', 'index');
        });

        Route::controller(apiCourseController::class)->group(function () {
            Route::get('course/getAll', 'index');
        });

        Route::controller(apiMarkController::class)->group(function () {
            Route::post('mark/getAll', 'index');
            Route::get('/user/{userId}/marks','getUserMarks');

        });

        Route::controller(apiPlanController::class)->group(function () {
            Route::get('plan/getAll', 'index');
        });

        Route::controller(apiExamController::class)->group(function () {
            Route::get('exam/getAll', 'index');
        });

        Route::controller(SearchController::class)->group(function () {
            Route::post('search', 'search');
        });

        Route::controller(UserController::class)->group(function () {
            Route::post('downloadPlan', 'downloadPlan');
            Route::post('downloadExam', 'downloadExam');
            Route::post('downloadMark', 'downloadMark');
            Route::get('getUserDownloads', 'getUserDownloads');
        });

    });
});
