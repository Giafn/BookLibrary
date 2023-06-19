<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $selected = 'bookList';
        $category = Category::all();
        return view('admin.category.index', compact('selected', 'category'));
    }
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:category'
        ]);
        if ($validator->fails()) {
           dd($validator->errors());
        }
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Category added successfully.');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $book = Books::where('category', $category->name);
        if ($book) {
            $book->update(
                [
                    'category' => 'Uncategorized'
                ]
            );
        }
        $category->delete();
        return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:category,name,'.$id
        ]);
        if ($validator->fails()) {
           dd($validator->errors());
        }
        $category = Category::find($id);
        $book = Books::where('category', $category->name);
        if ($book) {
            $book->update(
                [
                    'category' => $request->name
                ]
            );
        }
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
    }
}
