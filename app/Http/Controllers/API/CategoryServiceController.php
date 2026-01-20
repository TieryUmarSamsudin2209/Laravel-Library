<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryServiceController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return response([
            'message' => 'list category found!',
            'data' => $this->category->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],[
            'category_name.required' => "Category is required boss!!",
            'category_name.unique' => "Category has already on database my bos!!",
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect("/admin/category")->with("success", "category has been added!");
    }

     public function show($id)
    {
        $data = Category::find($id, ['*']);

        return view("categories.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],[
            'category_name.required' => "Category is required boss!!",
            'category_name.unique' => "Category has already on database my bos!!",
        ]);

        $data = Category::find($id, ['*']);
        $data->category_name = $request->category_name;
        $data->save();

        return redirect("/admin/category")->with("success", "category has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::find($id, ['*']);
        $data->delete();
        return redirect("/admin/category")->with("success", "category has been deleted!");
    }
}
