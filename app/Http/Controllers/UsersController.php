<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
class UsersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if( Auth::check() ){


            $users = User::all();

             return view('users.index', ['users'=> $users]);  
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
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    public function store(Request $data)
    {
        if(Auth::check()){
            $user = User::create([
                'name' => $data->input('name'),
                'email' => $data->input('email'),
                'password' => bcrypt($data['password']),

            ]);


            if($user){
                return redirect()->route('users.show', ['user'=> $user->id])
                ->with('success' , 'User created successfully');
            }

        }
        
            return back()->withInput()->with('errors', 'Error creating new user');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       $user = User::find($user->id);

        return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user->id);
        
        return view('users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, User $user)
    {
        
      $userUpdate = User::where('id', $user->id)
                                ->update([
                                        'name'=> $data->input('name'),
                                        'email'=> $data->input('data'),
                                         'password' => bcrypt($data['password']),

                                ]);

      if($userUpdate){
          return redirect()->route('users.show', ['user'=> $user->id])
          ->with('success' , 'User updated successfully');
      }
      //redirect
      return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        $findUser = User::find( $user->id);
		if($findUser->delete()){
            
            //redirect
            return redirect()->route('users.index')
            ->with('success' , 'User deleted successfully');
        }

        return back()->withInput()->with('error' , 'User could not be deleted');
        
    }
}
