<?php

// app/Http/Controllers/EmployeeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as FacadesView;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('skills')->get();
        return view('empolyess.index', compact('employees'));
    }

    public function create()
    {
        return view('empolyess.create');
    }
    public function show(Employee $employee)
    {
        return view('empolyess.show', compact('employee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'skills' => 'required|array|min:1',
            'skills.*' => 'string|max:255',
        ]);
    
   
        $employee = Employee::create([
            'name' => $request->input('name'),
        ]);
    
       
        foreach ($request->input('skills') as $skillName) {
            $employee->skills()->create([
                'name' => $skillName,
            ]);
        }
    
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    public function getSkillInput()
{
    $view = FacadesView::make('employees.skill-input')->render();
    return response()->json(['html' => $view]);
}

    public function edit(Employee $employee)
    {
        $employee->load('skills');
        return view('empolyess.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'skills' => 'required|array|min:1',
            'skills.*' => 'string|max:255',
        ]);

        $employee->update([
            'name' => $request->input('name'),
        ]);

        $employee->skills()->delete();

        foreach ($request->input('skills') as $skillName) {
            Skill::create([
                'employee_id' => $employee->id,
                'name' => $skillName,
            ]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
