<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function showAll()
    {
        $books = Books::all();
        return response()->json($books);
    }

    public function showByCategory($category)
    {
        $books = Books::where('category', $category)->get();
        return response()->json($books);
    }

    public function detail()
    {
        return view('user.detailBook');
    }

    public function showDetail($id)
    {
        $book = Books::find($id)->first();
        return response()->json($book);
    }

    

    
}
