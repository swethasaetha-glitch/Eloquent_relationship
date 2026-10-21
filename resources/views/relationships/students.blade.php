@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full uppercase">Basic Model & Relations</span>
                <h2 class="text-2xl font-bold text-slate-800">Students Directory</h2>
            </div>
            <p class="text-slate-500 text-sm mt-1">Student details, associated department (<code class="text-blue-600">belongsTo</code>), and profile status.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-lg transition-all w-fit">
            &larr; Back to Dashboard
        </a>
    </div>

    <!-- Code Explanation Card -->
    <div class="bg-slate-900 text-slate-100 rounded-2xl p-5 shadow-sm overflow-x-auto text-xs sm:text-sm">
        <div class="flex items-center justify-between text-slate-400 mb-2 border-b border-slate-800 pb-2">
            <span class="font-semibold text-sky-400">Eloquent Query in Controller</span>
            <span>Student.php &bull; Department.php</span>
        </div>
        <pre><code>// Eager load related Department and Profile models:
$students = Student::with(['department', 'profile', 'courses'])->get();

// In Student Model:
public function department(): BelongsTo {
    return $this->belongsTo(Department::class);
}</code></pre>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">All Registered Students ({{ $students->count() }})</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3.5">Roll No</th>
                        <th class="px-6 py-3.5">Student Name</th>
                        <th class="px-6 py-3.5">Email</th>
                        <th class="px-6 py-3.5">Department</th>
                        <th class="px-6 py-3.5">Year</th>
                        <th class="px-6 py-3.5">City / Phone</th>
                        <th class="px-6 py-3.5">Enrolled Courses</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-sky-700">{{ $student->roll_number }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $student->email }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-md border border-indigo-100">
                                    {{ $student->department->name ?? 'Unassigned' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">Year {{ $student->year_of_study }}</td>
                            <td class="px-6 py-4">
                                @if($student->profile)
                                    <div>{{ $student->profile->city }}</div>
                                    <div class="text-xs text-slate-400">{{ $student->profile->phone }}</div>
                                @else
                                    <span class="text-slate-400 italic">No profile</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-emerald-50 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-md">
                                    {{ $student->courses->count() }} courses
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-400">No students found. Run database seeder to populate records.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
