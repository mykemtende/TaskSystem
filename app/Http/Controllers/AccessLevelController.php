<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccessLevel;
use Illuminate\Support\Facades\Auth;

class AccessLevelController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){


            $accesslevels = AccessLevel::where('user_id', Auth::user()->id)->get();

             return view('accesslevels.index', ['accesslevels'=> $accesslevels]);  
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
      
        return view('accesslevels.create');
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
            $accesslevel = AccessLevel::create([
                'name' => $request->input('name'),
                'user_id' => Auth::user()->id
            ]);


            if($accesslevel){
                return redirect()->route('accesslevels.show', ['accesslevel'=> $accesslevel->id])
                ->with('success' , 'Access Level created successfully');
            }

        }
        
            return back()->withInput()->with('errors', 'Error creating new accesslevel');

    }

    /**
     * Display the specified resource.
     *
 
     * @return \Illuminate\Http\Response
     */
    public function show(AccessLevel $accesslevel)
    {
       
       $accesslevel = AccessLevel::find($accesslevel->id);

        return view('accesslevels.show', ['accesslevel'=>$accesslevel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessLevel $accesslevel)
    {
        $accesslevel = AccessLevel::find($accesslevel->id);
        
        return view('accesslevels.edit', ['accesslevel'=>$accesslevel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
   
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessLevel $accesslevel)
    {

      $accesslevelUpdate = AccessLevel::where('id', $accesslevel->id)
                                ->update([
                                        'name'=> $request->input('name'),
                                ]);

      if($accesslevelUpdate){
          return redirect()->route('accesslevels.show', ['accesslevel'=> $accesslevel->id])
          ->with('success' , 'Access Level updated successfully');
      }
      //redirect
      return back()->withInput();


      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessLevel $accesslevel)
    {

        $findAccessLevel = AccessLevel::find( $accesslevel->id);
		if($findAccessLevel->delete()){
            
            //redirect
            return redirect()->route('accesslevels.index')
            ->with('success' , 'Access Level deleted successfully');
        }

        return back()->withInput()->with('error' , 'Access Level could not be deleted');
        

    }
}
