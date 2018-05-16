<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
         
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){


            $departments = Department::where('user_id', Auth::user()->id)->get();

             return view('departments.index', ['departments'=> $departments]);  
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
       if(Auth::check()){
            $department = Department::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);


            if($department){
                return redirect()->route('departments.show', ['department'=> $department->id])
                ->with('success' , 'Department created successfully');
            }

        }
        
            return back()->withInput()->with('errors', 'Error creating new department');

    }

    /**
     * Display the specified resource.
     *

     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
       
       $department = Department::find($department->id);

        return view('departments.show', ['department'=>$department]);
    }

    /**
     * Show the form for editing the specified resource.
     *

     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $department = Department::find($department->id);
        
        return view('departments.edit', ['department'=>$department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {

      $departmentUpdate = Department::where('id', $department->id)
                                ->update([
                                        'name'=> $request->input('name'),
                                        'description'=> $request->input('description')
                                ]);

      if($departmentUpdate){
          return redirect()->route('departments.show', ['department'=> $department->id])
          ->with('success' , 'Department updated successfully');
      }
      //redirect
      return back()->withInput();


      
    }

    /**
     * Remove the specified resource from storage.
     *
 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {

        $findDepartment = Department::find( $department->id);
		if($findDepartment->delete()){
            
            //redirect
            return redirect()->route('departments.index')
            ->with('success' , 'Department deleted successfully');
        }

        return back()->withInput()->with('error' , 'Department could not be deleted');
        

    }
}
