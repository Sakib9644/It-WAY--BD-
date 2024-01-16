<?php

// app/Models/Employee.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function skills()
    {
        return $this->hasMany(Skill::class,'employee_id');
    }
}
