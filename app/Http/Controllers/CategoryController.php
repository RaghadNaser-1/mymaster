<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $categories = Category::paginate(9);
    //     return view('categories.index', compact('categories'));
    // }
    public function index(Request $request)
{
    $query = Category::query();

    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where('name', 'like', '%' . $searchTerm . '%');
    }

    $categories = $query->paginate(10); // Adjust the pagination size as needed

    return view('categories.index', compact('categories'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        // Create a new category using the validated data
        $category = Category::create($validatedData);

        // Optionally, you can redirect to the index page or show a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        // Update the category using the validated data
        $category->update($validatedData);

        // Optionally, you can redirect to the index page or show a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
