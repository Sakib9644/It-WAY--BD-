

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Employee Details</h2>
        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $employee->id }}</dd>

            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $employee->name }}</dd>

            <dt class="col-sm-3">Skills</dt>
            <dd class="col-sm-9">
                @forelse($employee->skills as $skill)
                    <span class="badge bg-secondary">{{ $skill->name }}</span>
                @empty
                    <span class="badge bg-warning">No skills</span>
                @endforelse
            </dd>
        </dl>

        <div class="mt-3">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employee List</a>
        </div>
    </div>
@endsection
