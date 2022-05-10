<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = StudentClass::all();
        return response()->json($classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'class_name' => 'required|unique:student_classes'
        ]);

        StudentClass::create([
           'class_name' => $request->class_name
        ]);

        return response('Class created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $class = StudentClass::findOrFail($id);
            return response()->json([
                'Response' => 'Success',
                'Class Name' => $class->class_name,
            ],200);
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'class_name'=>"required|unique:student_classes,class_name,$id"
        ]);

        $class = StudentClass::findOrFail($id);
        $class->update([
            'class_name' => $request->class_name
        ]);

        return response('Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            StudentClass::findOrFail($id)->delete();
            return response('Class deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
