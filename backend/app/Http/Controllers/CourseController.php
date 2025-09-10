<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(): JsonResponse
    {
        $course = Course::index();
        return response()->json($course, 200);
    }

    public function createCourse(Request $request): JsonResponse
    {
        try {

            $course = Course::createCourse(($request));
            return response()->json($course, 201);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function readCourse(Request $request): JsonResponse
    {
        $course = Course::readCourse($request->id);
        return response()->json($course, 200);
    }

    public function updateCourse(Request $request, $id): JsonResponse
    {
        try {

            $course = Course::updateCourse($request, $id);
            return response()->json($course, 200);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function deleteCourse($id): JsonResponse
    {
        Course::deleteCourse($id);
        return response()->json([], 204);
    }

    public function findAllStudents($id): JsonResponse
    {
        $search = Course::findOrFail($id);
        $students = $search->students;
        return response()->json($students, 200);
    }
}
