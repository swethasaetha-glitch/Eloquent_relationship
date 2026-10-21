@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase">One-to-Many</span>
                <h2 class="text-2xl font-bold text-slate-800">Departments &amp; Their Students</h2>
            </div>
            <p class="text-slate-500 text-sm mt-1">Demonstrates <code class="text-emerald-600 font-semibold">hasMany</code> on Department and <code class="text-emerald-600 font-semibold">belongsTo</code> on Student.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-all w-fit">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Code Explanation Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-emerald-400 font-bold mb-2 pb-2 border-b border-slate-800">1. Department Model (hasMany)</div>
            <pre><code>// App\Models\Department.php
public function students(): HasMany
{
    return $this->hasMany(Student::class);
}

// Access in Blade:
@@foreach($department->students as $student)
    @{{ $student->name }}
@@endforeach</code></pre>
        </div>

        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-emerald-400 font-bold mb-2 pb-2 border-b border-slate-800">2. Student Model (belongsTo - Inverse)</div>
            <pre><code>// App\Models\Student.php
public function department(): BelongsTo
{
    return $this->belongsTo(Department::class);
}

// Access in Blade:
$student->department->name;
$student->department->head_of_department;</code></pre>
        </div>
    </div>

    <!-- Departments with their Students -->
    <div class="space-y-6">
        @forelse($departments as $department)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <!-- Department Header -->
                <div class="p-6 bg-slate-50/70 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="bg-emerald-600 text-white font-mono font-bold text-xs px-2.5 py-1 rounded">
                                {{ $department->code }}
                            </span>
                            <h3 class="text-xl font-bold text-slate-800">{{ $department->name }}</h3>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">HOD: <span class="font-medium text-slate-700">{{ $department->head_of_department }}</span> &bull; {{ $department->description }}</p>
                    </div>
                    <div>
                        <span class="inline-flex items-center bg-emerald-100 text-emerald-800 text-xs font-semibold px-3 py-1.5 rounded-full">
                            {{ $department->students_count }} Students Enrolled
                        </span>
                    </div>
                </div>

                <!-- Students in Department -->
                <div class="p-6">
                    @if($department->students->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($department->students as $student)
                                <div class="p-4 rounded-xl border border-slate-100 bg-white hover:border-emerald-200 transition-all shadow-xs">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-mono font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                                            {{ $student->roll_number }}
                                        </span>
                                        <span class="text-[11px] text-slate-400">Year {{ $student->year_of_study }}</span>
                                    </div>
                                    <h4 class="font-bold text-slate-800 text-sm">{{ $student->name }}</h4>
                                    <p class="text-xs text-slate-500 mb-2">{{ $student->email }}</p>
                                    @if($student->profile)
                                        <p class="text-[11px] text-slate-400 border-t border-slate-100 pt-2">
                                            City: <span class="text-slate-600 font-medium">{{ $student->profile->city }}</span> &bull; Blood: <span class="text-rose-500 font-medium">{{ $student->profile->blood_group }}</span>
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-400 italic">No students currently enrolled in this department.</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white p-8 rounded-2xl text-center text-slate-400">
                No departments found.
            </div>
        @endforelse
    </div>
</div>
@endsection
