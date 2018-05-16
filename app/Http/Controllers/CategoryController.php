<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){


            $categories = Category::where('user_id', Auth::user()->id)->get();

             return view('categories.index', ['categories'=> $categories]);  
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
      
        return view('categories.create');
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
            $category = Category::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);


            if($category){
                return redirect()->route('categories.show', ['category'=> $category->id])
                ->with('success' , 'Category created successfully');
            }

        }
        
            return back()->withInput()->with('errors', 'Error creating new category');

    }

    /**
     * Display the specified resource.
     *
 
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       
       $category = Category::find($category->id);

        return view('categories.show', ['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::find($category->id);
        
        return view('categories.edit', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
   
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

      $categoryUpdate = Category::where('id', $category->id)
                                ->update([
                                        'name'=> $request->input('name'),
                                        'description'=> $request->input('description')
                                ]);

      if($categoryUpdate){
          return redirect()->route('categories.show', ['category'=> $category->id])
          ->with('success' , 'Category updated successfully');
      }
      //redirect
      return back()->withInput();


      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $findCategory = Category::find( $category->id);
		if($findCategory->delete()){
            
            //redirect
            return redirect()->route('categories.index')
            ->with('success' , 'Category deleted successfully');
        }

        return back()->withInput()->with('error' , 'Category could not be deleted');
        

    }
}
