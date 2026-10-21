<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'email',
        'roll_number',
        'year_of_study',
    ];

    /**
     * Inverse One-to-Many: Student belongs to a Department.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * One-to-One: Student has one Profile.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Many-to-Many: Student enrolls in many Courses with pivot attributes.
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_student')
            ->withPivot('grade', 'enrolled_at')
            ->withTimestamps();
    }

    /**
     * One-to-Many: Student has many enrollments.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Has One of Many: Student's latest enrollment.
     */
    public function latestEnrollment(): HasOne
    {
        return $this->hasOne(Enrollment::class)->latestOfMany('enrolled_at');
    }

    /**
     * Has One of Many: Student's oldest enrollment.
     */
    public function oldestEnrollment(): HasOne
    {
        return $this->hasOne(Enrollment::class)->oldestOfMany('enrolled_at');
    }
}
