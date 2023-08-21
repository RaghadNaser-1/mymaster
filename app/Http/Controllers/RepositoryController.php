<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $repositories = Repository::paginate(9);

    //     return view('repositories.index', compact('repositories'));
    // }
    public function index(Request $request)
{
    $query = Repository::query()->with('user');

    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('author', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('user', function ($subquery) use ($searchTerm) {
                $subquery->where('name', 'like', '%' . $searchTerm . '%');
            });
    }

    $repositories = $query->paginate(9); // Adjust the pagination size as needed

    return view('repositories.index', compact('repositories'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('repositories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'file_path' => 'required',
        'accepted' => 'required|boolean',
    ]);

    // Create a new repository item
    $repository = new Repository();
    $repository->title = $validatedData['title'];
    $repository->author = $validatedData['author'];
    $repository->file_path = $validatedData['file_path'];
    $repository->accepted = $validatedData['accepted'];
    $repository->user_id = auth()->user()->id; // Assuming you have authentication in place
    $repository->save();

    // Redirect or return a response as needed
    return redirect()->route('repositories.index')->with('success', 'Repository added successfully!');
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
    public function edit(Repository $repository)
{
    return view('repositories.edit', compact('repository'));
}

public function update(Request $request, Repository $repository)
{
    // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'file_path' => 'required',
        'accepted' => 'nullable|boolean', // Add the validation rule for 'accepted'
    ]);

    // Update the research item
    $repository->title = $validatedData['title'];
    $repository->author = $validatedData['author'];
    $repository->file_path = $validatedData['file_path'];

    // Check if 'accepted' value is present in the request
    if (isset($validatedData['accepted'])) {
        $repository->accepted = $validatedData['accepted'];
    }

    $repository->save();

    // Redirect or return a response as needed
    return redirect()->route('repositories.index')->with('success', 'Research updated successfully!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repository $repository)
{
    $repository->delete();

    // Redirect or return a response as needed
    return redirect()->route('repositories.index')->with('success', 'Research deleted successfully!');
}

}
