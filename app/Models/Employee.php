<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    public function department(){
        return $this->belongsToMany(Department::class, 'Department_employees', 'employee_id','department_id');
    }

    public function department_employee(){
        return $this->hasMany(Department_employee::class, 'employee_id', 'id');
    }

    public function de_id(){
        return $this->hasMany(Department_employee::class, 'employee_id', 'id');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($employee) {
            $employee->department_employee()->each(function($department_employee) {
                $department_employee->delete();
            });
        });
    }


}
