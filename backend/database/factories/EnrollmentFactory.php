<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    public function definition(): array
    {

        $studentIds = Student::pluck('id')->toArray();
        $courseIds = Course::pluck('id')->toArray();

        return [
            'student_id' => $this->faker->randomElement($studentIds),
            'course_id' => $this->faker->randomElement($courseIds),
            'progress_percentage' => $this->faker->numberBetween(0, 100),
            'enrollment_date' => $this->faker->dateTimeBetween('-3 year', '-2 year'),
            'completion_date' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
