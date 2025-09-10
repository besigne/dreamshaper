<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $course = new Course();
        return response()->json($course->index($request), 200);
    }

    public function createCourse(Request $request): JsonResponse
    {
        try {

            $course = new Course();
            return response()->json($course->createCourse($request), 201);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function readCourse(Request $request): JsonResponse
    {
        $course = new Course();
        return response()->json($course->readCourse($request->id), 200);
    }

    public function updateCourse(Request $request, $id): JsonResponse
    {
        try {

            $course = new Course();
            return response()->json($course->updateCourse($request, $id), 200);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function deleteCourse($id): JsonResponse
    {
        $course = new Course();
        $course->deleteCourse($id);
        return response()->json([], 204);
    }

    public function findAllStudents($id): JsonResponse
    {
        $search = Course::findOrFail($id);
        $students = $search->students;
        return response()->json($students, 200);
    }
}
