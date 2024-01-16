
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('employees.index') }}" class="btn btn-info mb-3">Employee Index</a>
        <h2>Edit Employee</h2>
        <form method="post" action="{{ route('employees.update', $employee->id) }}" id="employeeForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Employee Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
            </div>

            <!-- Skills section -->
            <div id="skills-container" class="mb-3">
                <label for="skills[]" class="form-label">Skills:</label>
                @foreach ($employee->skills as $skill)
                    <div class="input-group mb-3 skill-input">
                        <input type="text" name="skills[]" class="form-control" value="{{ $skill->name }}" required>
                        <button type="button" class="btn btn-outline-secondary remove-skill">Remove Skill</button>
                    </div>
                @endforeach
                <button type="button" class="btn btn-outline-secondary add-skill">Add Skill</button>
            </div>

            <button type="button" class="btn btn-primary" id="updateEmployeeBtn">Update Employee</button>
        </form>

        <!-- Success message -->
        <div class="alert alert-success mt-3" id="successMessage" style="display: none;">
            Employee updated successfully!
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const skillsContainer = $('#skills-container');
            const addSkillButton = $('.add-skill');
            const removeSkillButton = $('.remove-skill');
            const updateEmployeeBtn = $('#updateEmployeeBtn');
            const successMessage = $('#successMessage');

            addSkillButton.on('click', function () {
                const skillInput = `
                    <div class="input-group mb-3 skill-input">
                        <input type="text" name="skills[]" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary remove-skill">Remove Skill</button>
                    </div>
                `;
                skillsContainer.append(skillInput);
            });

           
            skillsContainer.on('click', '.remove-skill', function () {
                $(this).parent().remove();
            });

            updateEmployeeBtn.on('click', function (e) {
                e.preventDefault(); 
                $.ajax({
                    url: $('#employeeForm').attr('action'),
                    method: 'POST',
                    data: $('#employeeForm').serialize(),
                    success: function (data) {
                        successMessage.show(); 
                        setTimeout(function () {
                            successMessage.hide(); 
                        }, 3000);
                    },
                    error: function (xhr, status, error) {
                     
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
