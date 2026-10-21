<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Student;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    /**
     * Dashboard: College Management System overview.
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Students: Student details and departments.
     */
    public function students()
    {
        $students = Student::with(['department', 'profile', 'courses'])->get();

        return view('relationships.students', compact('students'));
    }

    /**
     * One-to-One: Student <-> Profile details.
     */
    public function oneToOne()
    {
        $students = Student::with('profile')->get();
        $profiles = Profile::with('student.department')->get();

        return view('relationships.one-to-one', compact('students', 'profiles'));
    }

    /**
     * One-to-Many: Departments and their students.
     */
    public function oneToMany()
    {
        $departments = Department::with('students.profile')->withCount('students')->get();

        return view('relationships.one-to-many', compact('departments'));
    }

    /**
     * Many-to-Many: Students, courses and grades (pivot table).
     */
    public function manyToMany()
    {
        $courses = Course::with('students')->get();
        $students = Student::with('courses')->get();

        return view('relationships.many-to-many', compact('courses', 'students'));
    }

    /**
     * Has One Through: Department's related profile via Student.
     */
    public function hasOneThrough()
    {
        // Department hasOneThrough Profile through Student
        $departments = Department::with(['studentProfile', 'students'])->get();

        return view('relationships.has-one-through', compact('departments'));
    }

    /**
     * Has Many Through: All profiles in each department via Students.
     */
    public function hasManyThrough()
    {
        // Department hasManyThrough Profile through Student
        $departments = Department::with('studentProfiles')->withCount('studentProfiles')->get();

        return view('relationships.has-many-through', compact('departments'));
    }

    /**
     * Has One of Many: Latest and oldest enrollments per student.
     */
    public function hasOneOfMany()
    {
        $students = Student::with([
            'latestEnrollment.course',
            'oldestEnrollment.course',
            'enrollments.course',
        ])->get();

        return view('relationships.has-one-of-many', compact('students'));
    }
}
