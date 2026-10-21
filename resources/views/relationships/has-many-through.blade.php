@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="bg-cyan-100 text-cyan-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase">Has Many Through</span>
                <h2 class="text-2xl font-bold text-slate-800">All Profiles in Each Department</h2>
            </div>
            <p class="text-slate-500 text-sm mt-1">Demonstrates <code class="text-cyan-600 font-semibold">hasManyThrough</code>: Department accesses ALL student profiles via the intermediate Student model.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-all w-fit">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Code Explanation Card -->
    <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2 border-b border-slate-800 pb-2">
            <span class="font-semibold text-cyan-400">Eloquent Definition in Department Model</span>
            <span>Department &rarr; Student &rarr; Profiles (Collection)</span>
        </div>
        <pre><code>// App\Models\Department.php
public function studentProfiles(): HasManyThrough
{
    return $this->hasManyThrough(Profile::class, Student::class);
}

// Controller:
$departments = Department::with('studentProfiles')->withCount('studentProfiles')->get();

// In Blade:
@@foreach($department->studentProfiles as $profile)
    @{{ $profile->city }} - @{{ $profile->phone }}
@@endforeach</code></pre>
    </div>

    <!-- Departments with all Profiles -->
    <div class="space-y-6">
        @forelse($departments as $department)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 bg-slate-50/70 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="bg-cyan-600 text-white font-mono font-bold text-xs px-2.5 py-1 rounded">
                                {{ $department->code }}
                            </span>
                            <h3 class="text-xl font-bold text-slate-800">{{ $department->name }}</h3>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Head of Dept: {{ $department->head_of_department }}</p>
                    </div>
                    <div>
                        <span class="bg-cyan-50 text-cyan-800 border border-cyan-200 text-xs font-semibold px-3 py-1.5 rounded-full">
                            {{ $department->student_profiles_count }} Profiles Retrieved via HasManyThrough
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    @if($department->studentProfiles->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($department->studentProfiles as $profile)
                                <div class="p-4 rounded-xl border border-slate-100 bg-white hover:border-cyan-200 transition-all shadow-xs">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-bold text-slate-800">{{ $profile->student->name ?? 'Student' }}</span>
                                        <span class="text-xs font-mono font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded">
                                            {{ $profile->blood_group }}
                                        </span>
                                    </div>
                                    <div class="space-y-1 text-xs text-slate-500 mb-3">
                                        <div><span class="text-slate-400">Phone:</span> {{ $profile->phone }}</div>
                                        <div><span class="text-slate-400">City:</span> {{ $profile->city }}</div>
                                        <div><span class="text-slate-400">DOB:</span> {{ $profile->date_of_birth ? $profile->date_of_birth->format('d M Y') : 'N/A' }}</div>
                                    </div>
                                    <p class="text-[11px] text-slate-600 bg-slate-50 p-2 rounded border border-slate-100 italic">
                                        "{{ $profile->bio }}"
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-400 italic">No student profiles found for this department.</p>
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
