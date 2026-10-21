@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase">Has One Through</span>
                <h2 class="text-2xl font-bold text-slate-800">Department's Related Profile</h2>
            </div>
            <p class="text-slate-500 text-sm mt-1">Demonstrates <code class="text-amber-600 font-semibold">hasOneThrough</code>: Department accesses Profile directly via intermediate Student model.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-all w-fit">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Visual Architecture Diagram & Code -->
    <div class="bg-slate-900 text-slate-100 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between text-slate-400 mb-4 pb-2 border-b border-slate-800">
            <span class="font-semibold text-amber-400">How Has One Through Works</span>
            <span class="text-xs">Department &rarr; Student (Intermediate) &rarr; Profile (Final Target)</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 text-center">
            <div class="bg-slate-800 p-4 rounded-xl border border-slate-700">
                <span class="text-xs text-slate-400 uppercase font-semibold">Source Model</span>
                <h4 class="font-bold text-base text-amber-300 mt-1">Department</h4>
                <p class="text-xs text-slate-400 mt-1">id: 1 (CSE)</p>
            </div>
            <div class="bg-slate-800 p-4 rounded-xl border border-slate-700 relative">
                <span class="text-xs text-sky-400 uppercase font-semibold">Intermediate Table</span>
                <h4 class="font-bold text-base text-sky-300 mt-1">Student</h4>
                <p class="text-xs text-slate-400 mt-1">department_id = 1</p>
            </div>
            <div class="bg-slate-800 p-4 rounded-xl border border-slate-700">
                <span class="text-xs text-emerald-400 uppercase font-semibold">Target Model</span>
                <h4 class="font-bold text-base text-emerald-300 mt-1">Profile</h4>
                <p class="text-xs text-slate-400 mt-1">student_id = student.id</p>
            </div>
        </div>

        <div class="text-xs sm:text-sm">
            <pre><code>// App\Models\Department.php
public function studentProfile(): HasOneThrough
{
    return $this->hasOneThrough(Profile::class, Student::class);
}

// Access directly in Blade:
$department->studentProfile->city;
$department->studentProfile->phone;</code></pre>
        </div>
    </div>

    <!-- Data Display Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($departments as $dept)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:border-amber-200 transition-all">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-mono font-bold bg-amber-50 text-amber-700 px-2 py-0.5 rounded">
                            {{ $dept->code }}
                        </span>
                        <span class="text-xs text-slate-400">
                            Dept ID #{{ $dept->id }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $dept->name }}</h3>
                    <p class="text-xs text-slate-500 mb-4">HOD: {{ $dept->head_of_department }}</p>

                    <div class="border-t border-slate-100 pt-3">
                        <div class="text-xs font-semibold text-amber-800 bg-amber-50 px-2.5 py-1 rounded inline-block mb-3">
                            Through Relation: <code class="text-amber-900 font-bold">$dept->studentProfile</code>
                        </div>

                        @if($dept->studentProfile)
                            <div class="space-y-2 text-xs bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Belongs to:</span>
                                    <span class="font-bold text-slate-700">{{ $dept->studentProfile->student->name ?? 'Student' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Phone:</span>
                                    <span class="font-medium">{{ $dept->studentProfile->phone }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">City:</span>
                                    <span class="font-medium">{{ $dept->studentProfile->city }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Blood Group:</span>
                                    <span class="font-bold text-rose-600">{{ $dept->studentProfile->blood_group }}</span>
                                </div>
                                <div class="pt-1">
                                    <span class="text-slate-400 block mb-0.5">Bio:</span>
                                    <p class="text-slate-600 italic text-[11px]">"{{ $dept->studentProfile->bio }}"</p>
                                </div>
                            </div>
                        @else
                            <p class="text-xs text-slate-400 italic">No student profile found for this department.</p>
                        @endif
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-400">
                    Fetched via 1 single <code class="text-amber-600">hasOneThrough</code> SQL join query.
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-8 rounded-2xl text-center text-slate-400">
                No departments found.
            </div>
        @endforelse
    </div>
</div>
@endsection
