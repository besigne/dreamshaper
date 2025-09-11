<?php

namespace App\Models;

use App\Http\Requests\EnrollmentRequest;
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

    public function index(): Collection|Enrollment
    {
        return Enrollment::all();
    }

    public function createEnrollment(EnrollmentRequest $request): Enrollment
    {
        return Enrollment::create($request->all());
    }

    public function updateProgress(Request $request, $id): Enrollment
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
