<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'cpf',
    ];

    public function index(): Collection|Student
    {
        return Student::all();
    }

    public function createStudent(Request $request): Student|null
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'cpf' => 'required|string|unique:students,cpf',
        ]);
        $student = Student::create($data);
        return $student;

    }

    public function readStudent($id): Student|null
    {
        return Student::find($id);
    }



    public function updateStudent(Request $request, $id): Student
    {

        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'cpf' => 'required|string|min:11|max:11',
        ]);

        $student->update($data);
        return $student;
    }

    public function deleteStudent($id): void
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}
