<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryStatusController extends Controller
{
    public function status(Category $category)
    {

        if($category->status==true)
        {
            $attributes=[
                'status' => false
            ];
        }
        else
        {
            $attributes=[
                'status' => true
            ];
        }
       $category->update($attributes);

        return redirect()->route('categories.index');
    }
}
