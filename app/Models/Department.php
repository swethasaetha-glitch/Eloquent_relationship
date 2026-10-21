<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'head_of_department',
        'description',
    ];

    /**
     * One-to-Many: A department has many students.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Has One of Many: Department's latest student.
     */
    public function latestStudent(): HasOne
    {
        return $this->hasOne(Student::class)->latestOfMany();
    }

    /**
     * Has One Through: Department's related profile via Student.
     * (e.g. Profile of the first student in the department)
     */
    public function studentProfile(): HasOneThrough
    {
        return $this->hasOneThrough(Profile::class, Student::class);
    }

    /**
     * Has Many Through: All student profiles belonging to this department.
     */
    public function studentProfiles(): HasManyThrough
    {
        return $this->hasManyThrough(Profile::class, Student::class);
    }
}
