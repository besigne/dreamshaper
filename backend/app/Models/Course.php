<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'duration_hours',
    ];

    public static function index(): Collection|Course
    {
        return Course::all();
    }

    public static function readCourse($id): Course|null
    {
        return Course::find($id);
    }

    public static function createCourse(Request $request): Course|null
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'duration_hours' => 'required|integer'
        ]);
        $course = Course::create($data);
        return $course;
    }

    public static function updateCourse(Request $request, $id): Course
    {

        $course = Course::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'duration_hours' => 'required|integer'
        ]);

        $course->update($data);
        return $course;
    }

    public static function deleteCourse($id): void
    {
        $course = Course::findOrFail($id);
        $course->delete();
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function findAllStudents($id): Collection|Student
    {
        return $this->students()->where('courses.id', $id)->get();
    }
}
