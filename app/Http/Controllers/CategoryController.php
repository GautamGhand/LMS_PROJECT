<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::where('user_id',Auth::id())->search(request(['search','newest']))->get(),
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
                'name' => 'required|min:3|max:255',
            ]);
    
        $attributes+=[
            'user_id' => Auth::id()
        ];
    
        Category::create($attributes);

        return redirect()->route('categories.index')->with('success','Successfully Created Category');
    }
    
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request,Category $category)
    {
        $attributes = $request->validate([
            'name'=> 'required|min:3|max:255',
        ]);
        
        $category->update($attributes);

        return redirect()->route('categories.index')->with('success','Successfully Updated Category');
    }
    public function destroy(Category $category)
    {
        $category->delete();  

        return redirect()->route('categories.index');
    }
}
