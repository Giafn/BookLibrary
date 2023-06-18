<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $selected = 'home';
        return view('admin.home', compact('selected'));
    }
    public function bookList()
    {
        $selected = 'bookList';
        $books = Books::all();
        return view('admin.bookList', compact('books', 'selected'));
    }
    public function addBook()
    {
        $selected = 'bookList';
        return view('admin.addBook', compact('selected'));
    }

}
