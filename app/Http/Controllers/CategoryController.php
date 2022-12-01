<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::with('user')->visibleTo()
                ->search(request(
                    ['search', 'newest']
                ))
                ->withCount('courses')
                ->get(),
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
        $attributes += [
            'user_id' => Auth::id()
        ];
    
        $category=Category::where('name', $request->name)->withTrashed()->first();
        if ($category) {
            if ($category->deleted_at != null) {
                $category->restore();
                $category->update($attributes);

                return redirect()->route('categories.index')
                    ->with('success', 'Category Created Successfully');
            }
        }
        Category::create($attributes);

        return redirect()->route('categories.index')
            ->with('success', 'Successfully Created Category');
    }
    
    public function edit(Category $category)
    {

        $this->authorize('update',$category);

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request,Category $category)
    {
        $this->authorize('update',$category);

        $attributes = $request->validate([
            'name' => ['required','min:3','max:255'],
            'category' => [
                'required',
                Rule::in(Category::visibleto()
                    ->get()
                    ->pluck('slug')
                    ->toArray()
                )
            ]
        ]);
        $category->update($attributes);

        return redirect()->route('categories.index')
            ->with('success', 'Successfully Updated Category');
    }
    public function destroy(Category $category)
    {
        $category->delete();  

        return redirect()->route('categories.index');
    }
}
