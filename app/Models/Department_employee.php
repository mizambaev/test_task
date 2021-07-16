<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department_employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'employee_id',
    ];
}
