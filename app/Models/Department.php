<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public function employee(){
        return $this->belongsToMany(Employee::class, 'Department_employees', 'department_id', 'employee_id');
    }

}
