<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'progress_percentage',
        'enrollment_date',
        'completion_date',
        'course_id',
        'student_id',
    ];

    public static function index(): Collection|Enrollment
    {
        return Enrollment::all();
    }

    public static function createEnrollment(Request $request): Enrollment
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            'progress_percentage' => 'required|integer|min:0|max:100',
            'enrollment_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
        ]);

        if (!isset($validated['enrollment_date'])) {
            $validated['enrollment_date'] = now();
        }

        return Enrollment::create($validated);
    }

    public static function updateProgress(Request $request, $id): Enrollment
    {

        $enrollment = Enrollment::findOrFail($id);

        $validated = $request->validate([
            'progress_percentage' => 'required|integer|min:0|max:100',
        ]);

        $enrollment->update($validated);
        return $enrollment;
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
