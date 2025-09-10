<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $student = Student::index();
        return response()->json($student, 200);
    }

    public function createStudent(Request $request): JsonResponse
    {
        try {

            $student = Student::createStudent(($request));
            return response()->json($student, 201);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function readStudent(Request $request): JsonResponse
    {
        $student = Student::readStudent($request->id);
        return response()->json($student, 200);
    }

    public function updateStudent(Request $request, $id): JsonResponse
    {
        try {

            $student = Student::updateStudent($request, $id);
            return response()->json($student, 200);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function deleteStudent($id): JsonResponse
    {
        Student::deleteStudent($id);
        return response()->json([], 204);
    }
}
