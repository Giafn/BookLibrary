<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

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
        $drive = Gdrive::all('location')->groupby('path');
        $books = Books::all();
        return view('admin.bookList', compact('books', 'selected', 'drive'));
    }
    public function addBook()
    {
        $selected = 'bookList';
        return view('admin.addBook', compact('selected'));
    }
    public function storeBook(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'description' => 'required',
            'category' => 'required',
            'copy' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($validator->fails()) {
           dd($validator->errors());
        }

        $book = new Books();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->publication_year = $request->year;
        $book->description = $request->description;
        $book->category = $request->category;
        $book->copies = $request->copy;
        $titlewithoutspace = str_replace(' ', '', $request->title);
        $book->image = $titlewithoutspace.$request->year.'.'.$request->file('image')->extension();
        $book->save();
        if ($book) {
            Gdrive::put('location/'.$titlewithoutspace.$request->year.'.'.$request->file('image')->extension(), $request->file('image'));
        }

        return redirect()->route('admin.bookList')->with('success', 'Book added successfully.');
    }
    public function deleteBook($id)
    {
        $book = Books::find($id);
        $delete = Gdrive::delete('location/'.$book->image);
        $book->delete();
        return redirect()->route('admin.bookList')->with('success', 'Book deleted successfully.');
    }
    public function getall()
    {
        $data = Gdrive::all('location')->groupby('path');
        return $data;
    }
}
