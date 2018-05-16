<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccessLevel;
use App\Task;
use App\Department;
use App\Category;
use App\User;
use App\TaskUser;
use Auth;
class TasksController extends Controller
{
    
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($accesslevel_id = null,$department_id = null)
    {
        if( Auth::check() ){

        $departments = null;
        $accesslevels = null;

         if(!$accesslevel_id){
            $accesslevels = AccessLevel::where('user_id', Auth::user()->id)->get();
         }
         if(!$department_id){
            $departments = Department::where('user_id', Auth::user()->id)->get();
         }
             $tasks = Task::where('user_id', Auth::user()->id)->get();
 
              return view('tasks.index', ['accesslevel_id'=>$accesslevel_id, 'accesslevels'=>$accesslevels,'department_id'=>$department_id, 'departments'=>$departments,'tasks'=> $tasks]);  
         }
         return view('auth.login');
    }


     public function adduser(Request $request){

         $task = Task::find($request->input('task_id'));

        

         if(Auth::user()->id == $task->user_id){

         $user = User::where('email', $request->input('email'))->first(); //single record

         //check if user is already added to the task
         $taskUser = TaskUser::where('user_id',$user->id)
                                    ->where('task_id',$task->id)
                                    ->first();
                                    
            if($taskUser){
                //if user already exists, exit 
         
                return response()->json(['success' ,  $request->input('email').' is already a member of this task']); 
               
            }


            if($user && $task){

                $task->users()->attach($user->id); 
               return redirect()->route('tasks.show', ['task'=> $task->id])
                 ->with(['success' ,  $request->input('email').' was added to the task successfully']);
                        
                    }
                    
         }

         return redirect()->route('tasks.show', ['task'=> $task->id])
         ->with('errors' ,  'Error adding user to task');
        

         
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($accesslevel_id = null,$category_id = null,$department_id = null)
    {
        
         $departments = null;
         $categories = null;
         $accesslevels = null;

         if(!$accesslevel_id){
            $accesslevels = AccessLevel::where('user_id', Auth::user()->id)->get();
         }

        if(!$category_id){
            $categories = Category::where('user_id', Auth::user()->id)->get();
         }
         if(!$department_id){
            $departments = Department::where('user_id', Auth::user()->id)->get();
         }


 
         return view('tasks.create',['accesslevel_id'=>$accesslevel_id, 'accesslevels'=>$accesslevels,'department_id'=>$department_id, 'departments'=>$departments, 'category_id'=>$category_id, 'categories'=>$categories]);
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
             $task = Task::create([
                 'name' => $request->input('name'),
                 'department_id' => $request->input('department_id'),
                'access_level_id' => $request->input('access_level_id'),
                 'user_id' => Auth::user()->id,
                 'duedate' => $request->input('duedate'),
                 'priority' => $request->input('priority'),
                 'category_id' => $request->input('category_id'),
                  'description' => $request->input('description'),

             ]);
 
 
             if($task){
                 return redirect()->route('tasks.show', ['task'=> $task->id])
                 ->with('success' , 'task created successfully');
             }
 
         }
         
             return back()->withInput()->with('errors', 'Error creating new task');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task = Task::find($task->id);
 
        $comments = $task->comments;
         return view('tasks.show', ['task'=>$task, 'comments'=> $comments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

 
            $accesslevels = AccessLevel::where('user_id', Auth::user()->id)->get();
         

   
            $categories = Category::where('user_id', Auth::user()->id)->get();
     
            $departments = Department::where('user_id', Auth::user()->id)->get();
         
        $task = Task::find($task->id);
         
         return view('tasks.edit', ['accesslevels'=>$accesslevels,'departments'=>$departments,'categories'=>$categories,'task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {
        $taskUpdate = Task::where('id', $task->id)
                                 ->update([
                 'name' => $request->input('name'),
                 'department_id' => $request->input('department_id'),
                'access_level_id' => $request->input('access_level_id'),
                 'duedate' => $request->input('duedate'),
                 'priority' => $request->input('priority'),
                 'category_id' => $request->input('category_id'),
                  'description' => $request->input('description'),
                                 ]);
 
       if($taskUpdate){
           return redirect()->route('tasks.show', ['task'=> $task->id])
           ->with('success' , 'Task updated successfully');
       }
       //redirect
       return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
         $findtask = Task::find( $task->id);
         if($findtask->delete()){
             
             //redirect
             return redirect()->route('tasks.index')
             ->with('success' , 'Task deleted successfully');
         }
 
         return back()->withInput()->with('error' , 'Task could not be deleted');
         
 
     }
    
}
