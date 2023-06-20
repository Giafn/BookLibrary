<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\BorowBook;
use App\Models\User;
use Illuminate\Http\Request;

class BorowBookController extends Controller
{
    public function index()
    {
        $data = BorowBook::join('users', 'users.id', '=', 'borow_book.user_id')
            ->join('book', 'book.id', '=', 'borow_book.book_id')
            ->where('borow_book.status', null)
            ->select('borow_book.*', 'users.name as user_name', 'book.title as book_title')
            ->get();
        $selected = "borrowed";
        return view('admin.borow_book.index', compact('data', 'selected'));
    }

    public function show(Request $request)
    {
        if (isset($request->id)) {
            $data = BorowBook::find($request->id);
        } else {
            $data = "";
        }
        $user = User::where('is_admin', null)
            ->select('id', 'name')
            ->get();
        $book = Books::where('copies', '>', 1)
            ->select('id', 'title', 'category')
            ->orderBy('category', 'asc')
            ->get();
        return response()->json([
            'user' => $user,
            'book' => $book,
            'data' => $data
        ]);
    }
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required',
            'book_id' => 'required',
            'date_return' => 'required',
        ]);
        $request = $request->all();
        $request['date_borow'] = date('Y-m-d');
        if ($validator->fails()) {
            dd($validator->errors());
        }
        $data = BorowBook::create($request);
        $book = Books::find($request['book_id']);
        $book->copies = $book->copies - 1;
        $book->save();
        return redirect()->route('admin.borowBook');
    }
    public function setBack($id)
    {
        $data = BorowBook::find($id);
        $book = Books::find($data->book_id);
        $book->copies = $book->copies + 1;
        $book->save();
        $data->delete();
        return response()->json([
            'message' => 'success'
        ]);
    }
    public function reqBorrow()
    {
        $data = BorowBook::join('users', 'users.id', '=', 'borow_book.user_id')
            ->join('book', 'book.id', '=', 'borow_book.book_id')
            ->where('borow_book.status', 1)
            ->select('borow_book.*', 'users.name as user_name', 'book.title as book_title')
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }
    public function approve($id)
    {
        $data = BorowBook::find($id);
        $book = Books::find($data->book_id);
        $book->copies = $book->copies - 1;
        $data->status = null;
        $book->save();
        $data->save();
        return response()->json([
            'message' => 'success'
        ]);
    }
}
