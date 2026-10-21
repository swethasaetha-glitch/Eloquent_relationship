@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="bg-rose-100 text-rose-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase">Has One of Many</span>
                <h2 class="text-2xl font-bold text-slate-800">Latest &amp; Oldest Enrollments</h2>
            </div>
            <p class="text-slate-500 text-sm mt-1">Demonstrates <code class="text-rose-600 font-semibold">latestOfMany()</code> and <code class="text-rose-600 font-semibold">oldestOfMany()</code> subquery relationships.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-all w-fit">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Code Explanation Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-rose-400 font-bold mb-2 pb-2 border-b border-slate-800">1. latestOfMany() in Student Model</div>
            <pre><code>// App\Models\Student.php
public function latestEnrollment(): HasOne
{
    return $this->hasOne(Enrollment::class)
        ->latestOfMany('enrolled_at');
}

// In Blade:
$student->latestEnrollment->course->title;
$student->latestEnrollment->enrolled_at;</code></pre>
        </div>

        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-rose-400 font-bold mb-2 pb-2 border-b border-slate-800">2. oldestOfMany() in Student Model</div>
            <pre><code>// App\Models\Student.php
public function oldestEnrollment(): HasOne
{
    return $this->hasOne(Enrollment::class)
        ->oldestOfMany('enrolled_at');
}

// In Blade:
$student->oldestEnrollment->course->title;
$student->oldestEnrollment->enrolled_at;</code></pre>
        </div>
    </div>

    <!-- Data Comparison Cards -->
    <div class="space-y-6">
        @forelse($students as $student)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-slate-100 gap-2 mb-4">
                    <div>
                        <span class="text-xs font-mono font-bold text-sky-700 bg-sky-50 px-2 py-0.5 rounded">{{ $student->roll_number }}</span>
                        <h3 class="text-lg font-bold text-slate-800 inline-block ml-2">{{ $student->name }}</h3>
                    </div>
                    <span class="text-xs text-slate-400 font-medium">Total Enrollments: {{ $student->enrollments->count() }}</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Oldest Enrollment Card -->
                    <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="bg-amber-100 text-amber-900 text-xs font-bold px-2.5 py-0.5 rounded">
                                oldestOfMany()
                            </span>
                            <span class="text-[11px] text-slate-400 font-medium">First Course Enrolled</span>
                        </div>

                        @if($student->oldestEnrollment)
                            <div class="mt-2 space-y-1 text-xs">
                                <h4 class="font-bold text-slate-800 text-sm">{{ $student->oldestEnrollment->course->title }}</h4>
                                <div class="text-slate-500">Course Code: <span class="font-mono font-medium">{{ $student->oldestEnrollment->course->code }}</span></div>
                                <div class="text-slate-500">Enrolled Date: <span class="font-medium text-slate-700">{{ $student->oldestEnrollment->enrolled_at->format('M d, Y') }}</span></div>
                                <div class="text-slate-500">Grade: <span class="font-bold text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">{{ $student->oldestEnrollment->grade ?? 'Pending' }}</span></div>
                            </div>
                        @else
                            <p class="text-xs text-slate-400 italic">No enrollment found.</p>
                        @endif
                    </div>

                    <!-- Latest Enrollment Card -->
                    <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="bg-emerald-100 text-emerald-900 text-xs font-bold px-2.5 py-0.5 rounded">
                                latestOfMany()
                            </span>
                            <span class="text-[11px] text-slate-400 font-medium">Most Recent Course</span>
                        </div>

                        @if($student->latestEnrollment)
                            <div class="mt-2 space-y-1 text-xs">
                                <h4 class="font-bold text-slate-800 text-sm">{{ $student->latestEnrollment->course->title }}</h4>
                                <div class="text-slate-500">Course Code: <span class="font-mono font-medium">{{ $student->latestEnrollment->course->code }}</span></div>
                                <div class="text-slate-500">Enrolled Date: <span class="font-medium text-slate-700">{{ $student->latestEnrollment->enrolled_at->format('M d, Y') }}</span></div>
                                <div class="text-slate-500">Grade: <span class="font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">{{ $student->latestEnrollment->grade ?? 'Pending' }}</span></div>
                            </div>
                        @else
                            <p class="text-xs text-slate-400 italic">No enrollment found.</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white p-8 rounded-2xl text-center text-slate-400">
                No enrollments found.
            </div>
        @endforelse
    </div>
</div>
@endsection
