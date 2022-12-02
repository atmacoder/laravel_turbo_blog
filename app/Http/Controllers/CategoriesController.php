<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function category_add(Request $request){
        $validator = $request->validateWithBag('category', [
            'name' => ['required', 'unique:categories', 'max:255'],
            'description' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('add-category')
                ->withErrors($validator)
                ->withInput();
        }
        //return redirect('add_category');
        return $request->all();
    }
}
