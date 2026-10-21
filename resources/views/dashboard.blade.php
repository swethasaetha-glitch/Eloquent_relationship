@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="border-b border-slate-200 pb-4">
        <h2 class="text-2xl font-bold text-[#1a2d42] tracking-tight">Relationship Pages</h2>
        <p class="text-slate-500 text-sm mt-1">Select an Eloquent relationship module below to inspect models, database schema, and live records.</p>
    </div>

    <!-- Cards Grid matching the screenshot -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Card 1: Students -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Students</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Student details and departments</p>
            </div>
            <div>
                <a href="{{ route('relationships.students') }}" class="inline-block bg-[#1b2f4a] hover:bg-[#142337] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors">
                    View Students
                </a>
            </div>
        </div>

        <!-- Card 2: One-to-One -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">One-to-One</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Student profile details</p>
            </div>
            <div>
                <a href="{{ route('relationships.one-to-one') }}" class="inline-block bg-[#1b2f4a] hover:bg-[#142337] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors">
                    View Profiles
                </a>
            </div>
        </div>

        <!-- Card 3: One-to-Many -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">One-to-Many</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Departments and their students</p>
            </div>
            <div>
                <a href="{{ route('relationships.one-to-many') }}" class="inline-block bg-[#1b2f4a] hover:bg-[#142337] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors">
                    View Departments
                </a>
            </div>
        </div>

        <!-- Card 4: Many-to-Many -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Many-to-Many</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Students, courses and grades</p>
            </div>
            <div>
                <a href="{{ route('relationships.many-to-many') }}" class="inline-block bg-[#1b2f4a] hover:bg-[#142337] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors">
                    View Courses
                </a>
            </div>
        </div>

        <!-- Card 5: Has One Through -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Has One Through</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Department's related profile</p>
            </div>
            <div>
                <a href="{{ route('relationships.has-one-through') }}" class="inline-block bg-[#1b2f4a] hover:bg-[#142337] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors">
                    View Profile
                </a>
            </div>
        </div>

        <!-- Card 6: Has Many Through -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Has Many Through</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">All profiles in each department</p>
            </div>
            <div>
                <a href="{{ route('relationships.has-many-through') }}" class="inline-block bg-[#1b2f4a] hover:bg-[#142337] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors">
                    View Profiles
                </a>
            </div>
        </div>

        <!-- Card 7: Has One of Many -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Has One of Many</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Latest and oldest enrollments</p>
            </div>
            <div>
                <a href="{{ route('relationships.has-one-of-many') }}" class="inline-block bg-[#1b2f4a] hover:bg-[#142337] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors">
                    View Enrollments
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
