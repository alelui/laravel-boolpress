<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;

class CategoryController extends Controller
{
    protected $validationRules = [
        "name" => "required|string|max:100|unique:categories,name"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        // dd($request->all());
        $data = $request->all();

        $newCategory = new Category();
        $newCategory->name = $data["name"];
        $newCategory->slug = Str::of($newCategory->name)->slug('-');
        $newCategory->save();

        return redirect()->route('categories.index', $newCategory->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validazione dati richiamndo funzione protected
        //$request->validate($this->validationRules);
        //validazione dati
        $request->validate([
            "name" => "required|string|max:100|unique:categories,name,{$category->id}"
        ]);

        $data = $request->all();
        //non creare una nuova istanza di oggetti
        $category->name = $data["name"];
        $category->slug = Str::of($category->name)->slug('-');
        $category->save();

        return redirect()->route('categories.index', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
