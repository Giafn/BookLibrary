<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class BookController extends Controller
{
    public function index()
    {
        $book = Books::all()->groupBy('category');
        $drive = Gdrive::all('location')->groupby('path');
        return view('user.home', compact('book', 'drive'));
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
