<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Category;
use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class AdminController extends Controller
{
    public function index()
    {
        $selected = 'home';
        $allBook = Books::all()->count();
        $borowNow = Books::join('borow_book', 'borow_book.book_id', 'book.id')
            ->where('borow_book.status', null)
            ->count();
        $countMember = \DB::table('users')
            ->where('is_admin', null)
            ->count();
        $mustReturnToday = \DB::table('borow_book')
            ->where('date_return', date('Y-m-d'))
            ->count();
        $lost = \DB::table('borow_book')
            ->where('status', 2)
            ->orWhere('status', 3)
            ->count();
        return view('admin.home', compact('selected', 'borowNow', 'countMember', 'mustReturnToday', 'lost', 'allBook'));
    }
    public function drive()
    {
        $selected = 'bookList';
        return view('admin.drive', compact('selected'));
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
        $category = Category::all();
        return view('admin.addBook', compact('selected', 'category'));
    }
    public function storeBook(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'description' => 'required',
            'category' => 'required|not_in:0',
            'copy' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.addBook')
                ->withErrors($validator)
                ->withInput();
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
    public function showImage($id)
    {
        $item = Books::where('id', $id)->first();
        $drive = Gdrive::all('location')->groupby('path');
        $link = "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=".$drive['location/'.$item->image]->first()['extraMetadata']['id'];
        return $link;
    }
    public function editBook($id)
    {
        $book = Books::find($id);
        $category = Category::all();
        $drive = Gdrive::all('location')->groupby('path');
        $link = "https://drive.google.com/thumbnail?authuser=0&sz=w320&id=".$drive['location/'.$book->image]->first()['extraMetadata']['id'];
        return response()->json(["data" => $book, "link" => $link, "category" => $category]);
    }
    public function updateBook(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'description' => 'required',
            'category' => 'required',
            'copy' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $book = Books::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->publication_year = $request->year;
        $book->description = $request->description;
        $book->category = $request->category;
        $book->copies = $request->copy;
        if ($request->file('image')) {
            $titlewithoutspace = str_replace(' ', '', $request->title);
            $delete = Gdrive::delete('location/'.$book->image);
            $book->image = $titlewithoutspace.$request->year.'.'.$request->file('image')->extension();
            $put = Gdrive::put('location/'.$titlewithoutspace.$request->year.'.'.$request->file('image')->extension(), $request->file('image'));
        }
        $book->save();

        return redirect()->route('admin.bookList')->with('success', 'Book updated successfully.');
    }
    public function destroy($id)
    {
        $book = Books::find($id);
        $delete = Gdrive::delete('location/'.$book->image);
        $book->delete();
        return redirect()->route('admin.bookList')->with('success', 'Book deleted successfully.');
    }
}
