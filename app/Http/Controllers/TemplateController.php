<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class TemplateController extends Controller
{
    public function index()
    {
        return view('demo.templates.index', [
            'categories' => Template::where('owner_id', Auth::id())->get()
        ]);
    }
    public function edit(Template $template)
    {
        $this->authorize('update', $template);
        
        return view('demo.templates.edit', [
            'category' => $template
        ]);
    }
    public function update(Request $request, Template $template)
    {
        $this->authorize('update', $template);

        $attributes = $request->validate([
            'name' => 'required|string|min:3'
        ]);

        $template->update($attributes);

        return redirect()->route('templates')->with('success', 'Category Updated Successfully');
    }
    public function delete(Template $template)
    {
        $template->where('parent_id', )->delete();

        return redirect()->route('templates')->with('success', 'Category Deleted Successfully');
    }

    public function push(Template $template)
    {
        $template::where('parent_id', $template->id)->update([
            'name' => $template->name
        ]);

        return redirect()->route('templates')->with('success', 'Category Pushed Successfully');
    }
}
