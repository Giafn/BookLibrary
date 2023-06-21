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
        if (!$request->search || $request->search == null) {
            return redirect()->back();
        }
        $allcategory = Category::all();
        $book = Books::where('title', 'like', '%' . $request->search . '%')->paginate(8);
        $search = $request->search;
        $typing = $request->search;
        $drive = Gdrive::all('location')->groupby('path');
        return view('user.filter', compact('book', 'search', 'drive', 'allcategory', 'typing'));
    }

    public function byCategory($idcategory)
    {
        // if id category = is number
        if (is_numeric($idcategory)) {
            $category = Category::where('id', $idcategory)->first();
        } else {
            $category = Category::where('name', $idcategory)->first();
        }
        $book = Books::where('category', $category->name)->paginate(8);
        $search = $category->name;
        $allcategory = Category::all();
        $drive = Gdrive::all('location')->groupby('path');
        return view('user.filter', compact('book', 'search', 'drive', 'allcategory'));
    }

    public function borrow(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'date_return' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'please fill all field correctly');
        }
        $book = BorowBook::where('book_id',$id)->where('user_id',auth()->user()->id)->first();
        if ($book) {
            return redirect()->back()->with('error', 'You have borrowed this book');
        }
        // if date return < date now
        if (strtotime($request->date_return) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->with('error', 'Date return must be greater than date now');
        }
        // if date return > date now + 30 day
        if (strtotime($request->date_return) > strtotime('+30 day', strtotime(date('Y-m-d')))) {
            return redirect()->back()->with('error', 'Date return must be less than date now + 30 day');
        }
        // if user has borrowed 4 books
        $count = BorowBook::where('user_id', auth()->user()->id)
            ->where('status', null)
            ->orWhere('status', 1)
            ->orWhere('status', 2);
        $lost = $count->get()->where('status', 2)->count();
        $count = $count->count();
        if ($count >= 4) {
            if ($lost > 0) {
                return redirect()->back()->with('error', 'You have borrowed / request borrow 4 books and you have ' . $lost . ' lost book to pay');
            }
            return redirect()->back()->with('error', 'You have borrowed / request borrow 4 books');
        }
        // if book copies = 0
        $book = Books::find($id);
        if ($book->copies == 0) {
            return redirect()->back()->with('error', 'Book stock is empty');
        }
        $borrow = new BorowBook();
        $borrow->user_id = auth()->user()->id;
        $borrow->book_id = $id;
        $borrow->date_borow = date('Y-m-d');
        $borrow->date_return = $request->date_return;
        $borrow->status = 1;
        $borrow->save();
        return redirect()->route('book.myBorrow')->with('success', 'Request borrow book success');
    }

    public function myBorrow()
    {
        $book = BorowBook::where('user_id', auth()->user()->id)
            ->whereIn('status', ['1','2',null])
            ->join('book', 'book.id', 'borow_book.book_id')
            ->select('book.*', 'borow_book.*')
            ->get();
            
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
        return redirect()->back()->with('success', 'cancel borrow request success');
    }

    public function setLost($id)
    {
        $book = BorowBook::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($book->status == null) {
            $book->status = 2;
            $book->save();
        } else {
            return redirect()->back()->with('error', 'error server');
        }
        if (!$book) {
            return redirect()->back()->with('error', 'error server');
        }
        return redirect()->back()->with('success', 'set lost book success');
    }
}
