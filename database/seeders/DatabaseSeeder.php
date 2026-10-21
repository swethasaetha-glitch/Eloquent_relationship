<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\Profile;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Departments
        $cse = Department::create([
            'name' => 'Computer Science & Engineering',
            'code' => 'CSE',
            'head_of_department' => 'Dr. K. Arumugam',
            'description' => 'Focuses on software engineering, algorithms, systems, and intelligent applications.',
        ]);

        $it = Department::create([
            'name' => 'Information Technology',
            'code' => 'IT',
            'head_of_department' => 'Dr. R. Meenakshi',
            'description' => 'Deals with networks, web applications, cloud infrastructure, and data science.',
        ]);

        $ece = Department::create([
            'name' => 'Electronics & Communication',
            'code' => 'ECE',
            'head_of_department' => 'Dr. S. Sundararajan',
            'description' => 'Covers microprocessors, signal processing, IoT, and embedded communication systems.',
        ]);

        // 2. Create Courses
        $courseDsa = Course::create([
            'code' => 'CS101',
            'title' => 'Data Structures & Algorithms',
            'credits' => 4,
            'instructor' => 'Prof. Anitha Selvan',
        ]);

        $courseDb = Course::create([
            'code' => 'CS201',
            'title' => 'Database Management Systems',
            'credits' => 4,
            'instructor' => 'Prof. Karthik Narayanan',
        ]);

        $courseWeb = Course::create([
            'code' => 'IT102',
            'title' => 'Full-Stack Web Development',
            'credits' => 3,
            'instructor' => 'Prof. Manoj Kumar',
        ]);

        $courseAi = Course::create([
            'code' => 'CS301',
            'title' => 'Artificial Intelligence & Machine Learning',
            'credits' => 4,
            'instructor' => 'Dr. K. Arumugam',
        ]);

        $courseIot = Course::create([
            'code' => 'EC204',
            'title' => 'Internet of Things (IoT) & Embedded Systems',
            'credits' => 3,
            'instructor' => 'Dr. S. Sundararajan',
        ]);

        // 3. Create Students & Profiles
        $studentsData = [
            // CSE Students
            [
                'dept' => $cse->id,
                'name' => 'Karthik Raja',
                'email' => 'karthik.raja@college.edu',
                'roll' => 'CSE202301',
                'year' => 3,
                'profile' => [
                    'phone' => '+91 98765 43210',
                    'blood_group' => 'O+',
                    'date_of_birth' => '2003-05-14',
                    'city' => 'Chennai',
                    'bio' => 'Passionate backend developer exploring Laravel, microservices, and distributed architecture.',
                ],
                'enrollments' => [
                    ['course_id' => $courseDsa->id, 'grade' => 'A+', 'enrolled_at' => Carbon::parse('2023-08-10')],
                    ['course_id' => $courseDb->id, 'grade' => 'A', 'enrolled_at' => Carbon::parse('2024-01-15')],
                    ['course_id' => $courseAi->id, 'grade' => 'A+', 'enrolled_at' => Carbon::parse('2024-08-01')],
                ],
            ],
            [
                'dept' => $cse->id,
                'name' => 'Priya Sundaram',
                'email' => 'priya.sundaram@college.edu',
                'roll' => 'CSE202302',
                'year' => 3,
                'profile' => [
                    'phone' => '+91 98765 12345',
                    'blood_group' => 'B+',
                    'date_of_birth' => '2003-08-22',
                    'city' => 'Coimbatore',
                    'bio' => 'Data analytics enthusiast and competitive programmer with a passion for algorithms.',
                ],
                'enrollments' => [
                    ['course_id' => $courseDsa->id, 'grade' => 'A', 'enrolled_at' => Carbon::parse('2023-08-10')],
                    ['course_id' => $courseAi->id, 'grade' => 'O', 'enrolled_at' => Carbon::parse('2024-08-01')],
                ],
            ],
            // IT Students
            [
                'dept' => $it->id,
                'name' => 'Anand Kumar',
                'email' => 'anand.kumar@college.edu',
                'roll' => 'IT202315',
                'year' => 2,
                'profile' => [
                    'phone' => '+91 98450 67890',
                    'blood_group' => 'A+',
                    'date_of_birth' => '2004-03-10',
                    'city' => 'Madurai',
                    'bio' => 'Full-stack enthusiast specializing in responsive web UI, RESTful APIs, and Vue.js.',
                ],
                'enrollments' => [
                    ['course_id' => $courseWeb->id, 'grade' => 'A+', 'enrolled_at' => Carbon::parse('2024-01-20')],
                    ['course_id' => $courseDb->id, 'grade' => 'B+', 'enrolled_at' => Carbon::parse('2024-08-12')],
                ],
            ],
            [
                'dept' => $it->id,
                'name' => 'Divya Ramesh',
                'email' => 'divya.ramesh@college.edu',
                'roll' => 'IT202316',
                'year' => 2,
                'profile' => [
                    'phone' => '+91 97890 34567',
                    'blood_group' => 'AB+',
                    'date_of_birth' => '2004-11-05',
                    'city' => 'Trichy',
                    'bio' => 'Cloud computing enthusiast and aspiring DevOps engineer with AWS certification.',
                ],
                'enrollments' => [
                    ['course_id' => $courseWeb->id, 'grade' => 'A', 'enrolled_at' => Carbon::parse('2024-01-20')],
                ],
            ],
            // ECE Students
            [
                'dept' => $ece->id,
                'name' => 'Sanjay Natarajan',
                'email' => 'sanjay.natarajan@college.edu',
                'roll' => 'ECE202325',
                'year' => 3,
                'profile' => [
                    'phone' => '+91 96543 21098',
                    'blood_group' => 'O-',
                    'date_of_birth' => '2003-01-30',
                    'city' => 'Salem',
                    'bio' => 'Hardware-software co-designer interested in robotics, Arduino, and smart automation.',
                ],
                'enrollments' => [
                    ['course_id' => $courseIot->id, 'grade' => 'A+', 'enrolled_at' => Carbon::parse('2023-08-15')],
                    ['course_id' => $courseDsa->id, 'grade' => 'B+', 'enrolled_at' => Carbon::parse('2024-01-10')],
                    ['course_id' => $courseAi->id, 'grade' => 'A', 'enrolled_at' => Carbon::parse('2024-08-05')],
                ],
            ],
        ];

        foreach ($studentsData as $data) {
            $student = Student::create([
                'department_id' => $data['dept'],
                'name' => $data['name'],
                'email' => $data['email'],
                'roll_number' => $data['roll'],
                'year_of_study' => $data['year'],
            ]);

            // Create Profile (One-to-One)
            $student->profile()->create($data['profile']);

            // Create Enrollments (Many-to-Many & Has-One-Of-Many)
            foreach ($data['enrollments'] as $enrollment) {
                Enrollment::create([
                    'student_id' => $student->id,
                    'course_id' => $enrollment['course_id'],
                    'grade' => $enrollment['grade'],
                    'enrolled_at' => $enrollment['enrolled_at'],
                ]);
            }
        }
    }
}
