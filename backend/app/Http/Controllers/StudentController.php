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

            $student = new Student();
            return response()->json($student->createStudent($request), 201);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function readStudent(Request $request): JsonResponse
    {
        $student = new Student();
        return response()->json($student->readStudent($request->id), 200);
    }

    public function updateStudent(Request $request, $id): JsonResponse
    {
        try {

            $student = new Student();
            return response()->json($student->updateStudent($request, $id), 200);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function deleteStudent($id): JsonResponse
    {
        $student = new Student();
        $student->deleteStudent($id);
        return response()->json([], 204);
    }
}
