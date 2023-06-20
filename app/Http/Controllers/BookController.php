<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\BorowBook;
use App\Models\Category;
use Illuminate\Http\Request;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class BookController extends Controller
{
    public function index()
    {
        $listCategory = Books::join('category', 'category.name', 'book.category')
        ->select('category.name')
        ->get()->toArray();
        $list = array_values(array_unique(array_column($listCategory, 'name')));
        $list = array_rand(array_flip($list), 3);
        $book = Books::where('category', 'like', '%' . $list[0] . '%')
            ->orWhere('category', 'like', '%' . $list[1] . '%')
            ->orWhere('category', 'like', '%' . $list[2] . '%')
            ->get()->groupBy('category');
        $allcategory = Category::all();
        try {
            $drive = Gdrive::all('location')->groupby('path');
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        return view('user.home', compact('book', 'drive', 'list', 'allcategory'));
    }

    public function detail($id)
    {
        $data = Books::find($id);
        return view('user.detailBook', compact('data'));
    }

    public function search(Request $request)
    {
        $allcategory = Category::all();
        $book = Books::where('title', 'like', '%' . $request->search . '%')->get();
        $search = $request->search;
        $drive = Gdrive::all('location')->groupby('path');
        return view('user.filter', compact('book', 'search', 'drive', 'allcategory'));
    }

    public function byCategory($idcategory)
    {
        // if id category = is number
        if (is_numeric($idcategory)) {
            $category = Category::where('id', $idcategory)->first();
        } else {
            $category = Category::where('name', $idcategory)->first();
        }
        $book = Books::where('category', $category->name)->get();
        $search = $category->name;
        $allcategory = Category::all();
        $drive = Gdrive::all('location')->groupby('path');
        return view('user.filter', compact('book', 'search', 'drive', 'allcategory'));
    }

    public function borrow(Request $request, $id)
    {
        $validator = $request->validate([
            'date_return' => 'required',
        ]);
        $book = BorowBook::where('book_id',$id)->where('user_id',auth()->user()->id)->first();
        if ($book) {
            return redirect()->back()->with('error', 'You have borrowed this book');
        }
        $borrow = new BorowBook();
        $borrow->user_id = auth()->user()->id;
        $borrow->book_id = $id;
        $borrow->date_borow = date('Y-m-d');
        $borrow->date_return = $request->date_return;
        $borrow->status = 1;
        $borrow->save();
        return redirect()->route('home')->with('success', 'Borrow book success');
    }

    public function myBorrow()
    {
        $book = BorowBook::where('borow_book.user_id', auth()->user()->id)
            ->join('book', 'book.id', 'borow_book.book_id')
            ->select('book.*', 'borow_book.*')
            ->get();
        // dd($book);
        return view('user.myBorrow', compact('book'));
    }

    public function cancelBorrow($id)
    {
        $book = BorowBook::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($book->status == 1) {
            $book->delete();
        } else {
            return redirect()->back()->with('error', 'cancel book must by admin');
        }
        return redirect()->back()->with('success', 'Return book success');
    }
}
