<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Category;
use App\User;
use Auth;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         
         if( Auth::check() ){
             $projects = Project::where('user_id', Auth::user()->id)->get();
 
              return view('projects.index', ['projects'=> $projects]);  
         }
         return view('auth.login');
     }
 
   public function indexAll()
     {
         
         if( Auth::check() ){
             $projects = Project::all();
 
              return view('projects.all', ['projects'=> $projects]);  
         }
         return view('auth.login');
     }
     

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create( $category_id = null )
     {
         //

         $categories = null;
         if(!$category_id){
            $categories = Category::where('user_id', Auth::user()->id)->get();
         }
 
         return view('projects.create',['category_id'=>$category_id, 'categories'=>$categories]);
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         //
 
         if(Auth::check()){
             $project = Project::create([
                 'name' => $request->input('name'),
                 'description' => $request->input('description'),
                 'category_id' => $request->input('category_id'),
                 'user_id' => Auth::user()->id
             ]);
 
 
             if($project){
                 return redirect()->route('projects.show', ['project'=> $project->id])
                 ->with('success' , 'project created successfully');
             }
 
         }
         
             return back()->withInput()->with('errors', 'Error creating new project');
 
     }

    
 
     /**
      * Display the specified resource.
      *
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function show(Project $project)
     {
       
        $project = Project::find($project->id);
 
        $comments = $project->comments;
         return view('projects.show', ['project'=>$project, 'comments'=> $comments ]);
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function edit(Project $project)
     {
         //
         $project = Project::find($project->id);
         
         return view('projects.edit', ['project'=>$project]);
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, project $project)
     {
        
 
       $projectUpdate = Project::where('id', $project->id)
                                 ->update([
                                         'name'=> $request->input('name'),
                                         'description'=> $request->input('description')
                                 ]);
 
       if($projectUpdate){
           return redirect()->route('projects.show', ['project'=> $project->id])
           ->with('success' , 'project updated successfully');
       }
       //redirect
       return back()->withInput();
 
 
       
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\project  $project
      * @return \Illuminate\Http\Response
      */
     public function destroy(Project $project)
     {
 
         $findproject = Project::find( $project->id);
         if($findproject->delete()){
             
             //redirect
             return redirect()->route('projects.index')
             ->with('success' , 'project deleted successfully');
         }
 
         return back()->withInput()->with('error' , 'project could not be deleted');
         
 
     }
}
