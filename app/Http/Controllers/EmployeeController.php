<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Department_employee;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(){
        $employees = Employee::with('department')->get();

        return view('Employee/index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(){
        $departments = Department::all();

        return view('Employee/create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'salary' => 'integer',
            'department_id' => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }else{
            $id = Employee::insertGetId([
                'name' => $request->post('name'),
                'surname' => $request->post('surname'),
                'patronymic' => $request->post('patronymic'),
                'gender' => $request->post('gender'),
                'salary' => $request->post('salary'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if($id){
                $data = array();
                foreach ($request->post('department_id') as $department_id){
                    $data[] = [
                        'employee_id'=>$id,
                        'department_id'=> $department_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }

                Department_employee::insert($data);
            }

            return response()->json(['success' => true]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id){
        $employee = Employee::with('department')->findOrFail($id);
        $departments = Department::all();
        return view('Employee/edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'salary' => 'integer',
            'department_id' => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }else{
            $result = Employee::query()->where('id', $id)->update([
                'name' => $request->post('name'),
                'surname' => $request->post('surname'),
                'patronymic' => $request->post('patronymic'),
                'gender' => $request->post('gender'),
                'salary' => $request->post('salary'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);


            if($result == 1){
                $test = Employee::find($id);

                $department_ids = $test->department_employee()->select(['department_id', 'id'])->get();
                $data = $request->post('department_id');

                foreach ($department_ids as $department_id){
                    if(array_search($department_id->department_id, $data) === false){
                        Department_employee::where('id', $department_id->id)->delete();
                    }
                }

                foreach ($data as $department_id){
                    Department_employee::firstOrCreate(['employee_id'=>$id, 'department_id'=> $department_id]);
                }

            }

            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id){
        $result = Employee::destroy($id);

        if($result == 0){
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}
