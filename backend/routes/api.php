<?php

use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::post('/', [CourseController::class, 'createCourse']);
    Route::get('/{id}', [CourseController::class, 'readCourse']);
    Route::put('/{id}', [CourseController::class, 'updateCourse']);
    Route::delete('/{id}', [CourseController::class, 'deleteCourse']);
    Route::get('/{id}/students', [CourseController::class, 'findAllStudents']);
});
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/', [StudentController::class, 'createStudent']);
    Route::get('/{id}', [StudentController::class, 'readStudent']);
    Route::put('/{id}', [StudentController::class, 'updateStudent']);
    Route::delete('/{id}', [StudentController::class, 'deleteStudent']);
});
Route::prefix('enrollments')->group(function () {
    Route::get('/', [EnrollmentController::class, 'index']);
    Route::post('/', [EnrollmentController::class, 'createEnrollment']);
    Route::get('/{id}', [EnrollmentController::class, 'readEnrollment']);
    Route::put('/{id}/progress', [EnrollmentController::class, 'updateProgress']);
    Route::delete('/{id}', [EnrollmentController::class, 'delete']);
});
