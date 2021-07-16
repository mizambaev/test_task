<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(){

        $departments = Department::select(['title', 'id'])
                                    ->withCount('employee')
                                    ->withMax('employee', 'salary')
                                    ->get();

        return view('Department/index', compact('departments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request){
        $validator = \Validator::make($request->all(), [
            'title' => 'required|unique:departments'
        ]);

        if(!$validator->passes()){
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }else{
            $insert_id = Department::insertGetId([
                                'title' => $request->post('title'),
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);

            return response()->json(['success' => true, 'title' => $request->post('title'), 'id' => $insert_id]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        // TODO
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id){
        $department = Department::find($id);

        if($department == null){
            return response()->json(['success' => false]);;
        }
        else{
            return response()->json(['success' => true, 'data' => $department]);;
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'title' => 'required|unique:departments'
        ]);

        if(!$validator->passes()){
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()]);
        }
        else{
            Department::where('id', $id)->update([
                'title' => $request->title,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return response()->json(['success' => true, 'title' => $request->title, 'id' => $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id){
        $department = Department::withCount('employee')->where('id',$id)->first();

        if($department['employee_count'] !== 0){
            return response()->json(['success' => false, 'error_msg' => 'Нельзя удалить отдел с сотрудниками!']);
        }
        else{
            Department::where('id', $id)->delete();

            return response()->json(['success' => true]);
        }

    }
}
