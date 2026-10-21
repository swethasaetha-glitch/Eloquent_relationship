@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase">Many-to-Many</span>
                <h2 class="text-2xl font-bold text-slate-800">Students, Courses &amp; Grades</h2>
            </div>
            <p class="text-slate-500 text-sm mt-1">Demonstrates <code class="text-purple-600 font-semibold">belongsToMany</code> with pivot table attributes (<code class="text-purple-600">grade</code>, <code class="text-purple-600">enrolled_at</code>).</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-all w-fit">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Code Explanation Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-purple-400 font-bold mb-2 pb-2 border-b border-slate-800">1. Student Model &amp; Pivot Table</div>
            <pre><code>// App\Models\Student.php
public function courses(): BelongsToMany
{
    return $this->belongsToMany(Course::class, 'course_student')
        ->withPivot('grade', 'enrolled_at')
        ->withTimestamps();
}

// Access pivot columns in Blade:
$course->pivot->grade;
$course->pivot->enrolled_at;</code></pre>
        </div>

        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-purple-400 font-bold mb-2 pb-2 border-b border-slate-800">2. Course Model (Inverse)</div>
            <pre><code>// App\Models\Course.php
public function students(): BelongsToMany
{
    return $this->belongsToMany(Student::class, 'course_student')
        ->withPivot('grade', 'enrolled_at')
        ->withTimestamps();
}

// Access enrolled students:
$course->students;</code></pre>
        </div>
    </div>

    <!-- Section 1: Courses with Enrolled Students & Grades -->
    <div class="space-y-6">
        <h3 class="text-xl font-bold text-slate-800">Courses with Enrolled Students (Inverse View)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($courses as $course)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-purple-50 text-purple-700 text-xs font-mono font-bold px-2.5 py-1 rounded">
                                {{ $course->code }} &bull; {{ $course->credits }} Credits
                            </span>
                            <span class="text-xs text-slate-400 font-medium">
                                {{ $course->students->count() }} enrolled
                            </span>
                        </div>

                        <h4 class="text-lg font-bold text-slate-800 mb-1">{{ $course->title }}</h4>
                        <p class="text-xs text-slate-500 mb-4">Instructor: {{ $course->instructor }}</p>

                        <div class="border-t border-slate-100 pt-3">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Enrolled Students &amp; Grades (via Pivot):</p>
                            @if($course->students->count() > 0)
                                <div class="space-y-2">
                                    @foreach($course->students as $student)
                                        <div class="flex items-center justify-between text-xs bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                                            <div>
                                                <span class="font-bold text-slate-700">{{ $student->name }}</span>
                                                <span class="text-slate-400 font-mono ml-1">({{ $student->roll_number }})</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-slate-400 text-[11px]">{{ $student->pivot->enrolled_at }}</span>
                                                <span class="bg-purple-100 text-purple-800 font-bold px-2 py-0.5 rounded text-xs">
                                                    {{ $student->pivot->grade ?? 'Pending' }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs text-slate-400 italic">No students enrolled yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-2xl text-center text-slate-400">
                    No courses found.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Section 2: Student Enrollment Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Student Course Enrollments (Student Perspective)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3.5">Student</th>
                        <th class="px-6 py-3.5">Roll Number</th>
                        <th class="px-6 py-3.5">Enrolled Courses &amp; Grade</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($students as $student)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $student->name }}</td>
                            <td class="px-6 py-4 font-mono text-sky-700 text-xs">{{ $student->roll_number }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @forelse($student->courses as $c)
                                        <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-700 text-xs px-2.5 py-1 rounded-md border border-slate-200">
                                            <span class="font-semibold">{{ $c->code }}</span>
                                            <span class="text-slate-400">&bull;</span>
                                            <span class="font-bold text-purple-700">{{ $c->pivot->grade }}</span>
                                        </span>
                                    @empty
                                        <span class="text-slate-400 italic text-xs">No courses</span>
                                    @endforelse
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
