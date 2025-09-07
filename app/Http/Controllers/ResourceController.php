<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ResourceController extends Controller
{
    // Show all categories
    public function categories()
    {
        $categories = Category::all();
        return view('resources.categories', compact('categories'));
    }

    // Show resources in a category
    public function showCategory(Category $category)
    {
        $resources = $category->resources()->latest()->get();
        return view('resources.list', compact('category','resources'));
    }

    // Upload form
    public function create()
    {
        $categories = Category::all();
        return view('resources.create', compact('categories'));
    }

    // Store new resource locally
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'category_id'=>'required|exists:categories,id',
            'type'=>'required|in:article,video,pdf',
            'file'=>'required|file|max:10240', // max 10MB
        ]);

        // Store file locally in storage/app/public/resources
        $filePath = $request->file('file')->store('resources', 'public');

        Resource::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'file_url' => '/storage/'.$filePath, // accessible URL
            'description' => $request->description,
        ]);

        return redirect()->route('resources.categories')->with('success','Resource uploaded!');
    }

    // Delete resource and local file
    public function destroy(Resource $resource)
    {
        // Delete file from local storage
        if($resource->file_url){
            $filePath = str_replace('/storage/', '', $resource->file_url);
            Storage::disk('public')->delete($filePath);
        }

        // Delete resource from DB
        $resource->delete();

        return back()->with('success','Resource deleted!');
    }
}
