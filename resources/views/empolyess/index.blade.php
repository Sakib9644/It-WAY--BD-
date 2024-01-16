<!-- resources/views/employees/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Employee List</h2>
    
     
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create Employee</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Skills</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $i => $employee)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>
                            @forelse($employee->skills as $skill)
                                <span class="badge bg-secondary">{{ $skill->name }}</span>
                            @empty
                                <span class="badge bg-warning">No skills</span>
                            @endforelse
                        </td>
                        <td>
                            <!-- Show Button -->
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">
                                Show
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <!-- Delete Button with Confirmation -->
                            <form method="post" action="{{ route('employees.destroy', $employee->id) }}"
                                style="display: inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No employees found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
