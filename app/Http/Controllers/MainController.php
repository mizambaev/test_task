<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     *
     * @return
     */
    public function index(){
        $departments = Department::query()->select(['title', 'id'])->get();

        $employees = Employee::with('de_id:department_id,employee_id')->get();
//        dd(array_column($employees, 'de_id'));
//        $employees = Employee::with(['department_employee' => function($query) {
//            $query->select('department_id');
//        }])->get();

//
//        $employees->push($departments);
//
//        dd($employees->toArray());

        return view('home', compact('departments','employees'));
    }

}
