<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index(): JsonResponse
    {
        $enrollment = Enrollment::index();
        return response()->json($enrollment, 200);
    }

    public function createEnrollment(Request $request): JsonResponse
    {
        try {

            $enrollment = new Enrollment();
            return response()->json($enrollment->createEnrollment($request), 201);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }

    public function updateProgress(Request $request, $id): JsonResponse
    {
        try {

            $enrollment = new Enrollment();
            return response()->json($enrollment->updateProgress($request, $id), 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        }
    }
}
