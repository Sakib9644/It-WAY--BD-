@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('employees.index') }}" class="btn btn-info mb-3">Employee Index</a>
        <h2>Create Employee</h2>
        <form method="post" action="{{ route('employees.store') }}" id="employeeForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Employee Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <!-- Skills section -->
            <div id="skills-container" class="mb-3">
                <label for="skills[]" class="form-label">Skills:</label>
                <div class="input-group">
                    <input type="text" name="skills[]" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary add-skill">Add Skill</button>
                </div>
            </div>

            <button type="button" class="btn btn-primary" id="createEmployeeBtn">Create Employee</button>
        </form>

        <!-- Success message -->
        <div class="alert alert-success mt-3" id="successMessage" style="display: none;">
            Employee created successfully!
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skillsContainer = $('#skills-container');
            const addSkillButton = $('.add-skill');
            const createEmployeeBtn = $('#createEmployeeBtn');
            const successMessage = $('#successMessage');

            addSkillButton.on('click', function() {
                const skillInput = document.createElement('div');
                skillInput.classList.add('mb-3', 'skill-input');
                skillInput.innerHTML = `
                    <label for="skills[]" class="form-label">Skill:</label>
                    <div class="input-group">
                        <input type="text" name="skills[]" class="form-control" required>
                    </div>
                `;
                skillsContainer.append(skillInput);
            });

            createEmployeeBtn.on('click', function() {
                $.ajax({
                    url: '{{ route('employees.skill-input') }}',
                    method: 'GET',
                    success: function(data) {
                        skillsContainer.append(data.html);
                    }
                });


                successMessage.show();
            });


            createEmployeeBtn.on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $('#employeeForm').attr('action'),
                    method: 'POST',
                    data: $('#employeeForm').serialize(),
                    success: function(data) {
                        successMessage.show();
                        setTimeout(function() {
                            successMessage.hide();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        
                        console.error(xhr.responseText);
                    }
                });
            });
        });

      
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
