@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase">One-to-One</span>
                <h2 class="text-2xl font-bold text-slate-800">Student Profile Details</h2>
            </div>
            <p class="text-slate-500 text-sm mt-1">Demonstrates <code class="text-indigo-600 font-semibold">hasOne</code> and its inverse <code class="text-indigo-600 font-semibold">belongsTo</code>.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-all w-fit">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Code Explanation Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-indigo-400 font-bold mb-2 pb-2 border-b border-slate-800">1. Student Model (hasOne)</div>
            <pre><code>// App\Models\Student.php
public function profile(): HasOne
{
    return $this->hasOne(Profile::class);
}

// Access in Blade:
$student->profile->phone;
$student->profile->bio;</code></pre>
        </div>

        <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm text-xs sm:text-sm">
            <div class="text-indigo-400 font-bold mb-2 pb-2 border-b border-slate-800">2. Profile Model (belongsTo - Inverse)</div>
            <pre><code>// App\Models\Profile.php
public function student(): BelongsTo
{
    return $this->belongsTo(Student::class);
}

// Access in Blade:
$profile->student->name;
$profile->student->roll_number;</code></pre>
        </div>
    </div>

    <!-- Profiles List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($students as $student)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:border-indigo-200 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-mono font-bold bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded">
                            {{ $student->roll_number }}
                        </span>
                        <span class="text-xs text-slate-400 font-medium">
                            Student ID #{{ $student->id }}
                        </span>
                    </div>

                    <h4 class="text-lg font-bold text-slate-800">{{ $student->name }}</h4>
                    <p class="text-xs text-slate-500 mb-4">{{ $student->email }}</p>

                    @if($student->profile)
                        <div class="space-y-2 border-t border-slate-100 pt-3 text-xs text-slate-600">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Phone:</span>
                                <span class="font-medium text-slate-700">{{ $student->profile->phone }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Blood Group:</span>
                                <span class="font-bold text-rose-600">{{ $student->profile->blood_group }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Date of Birth:</span>
                                <span class="font-medium">{{ $student->profile->date_of_birth ? $student->profile->date_of_birth->format('M d, Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">City:</span>
                                <span class="font-medium">{{ $student->profile->city }}</span>
                            </div>
                            <div class="pt-2">
                                <span class="text-slate-400 block mb-1">Bio:</span>
                                <p class="text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-100 italic text-xs leading-relaxed">
                                    "{{ $student->profile->bio }}"
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="bg-amber-50 text-amber-700 text-xs p-3 rounded-lg border border-amber-100 mt-2">
                            No profile record linked to this student yet.
                        </div>
                    @endif
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-400 text-right">
                    Relationship: <code class="text-indigo-600 font-semibold">$student->profile</code>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-8 rounded-2xl text-center text-slate-400">
                No profiles found. Run seeders to populate data.
            </div>
        @endforelse
    </div>
</div>
@endsection
