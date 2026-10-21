<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'phone',
        'blood_group',
        'date_of_birth',
        'city',
        'bio',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Inverse One-to-One: Profile belongs to a Student.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
