<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryStatusController extends Controller
{
    public function status(Category $category,$status)
    {
        $attributes=[
            'status' => $status
        ];

       $category->update($attributes);

        return redirect()->route('categories.index');
    }
}
