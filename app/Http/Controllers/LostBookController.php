<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\BorowBook;
use Illuminate\Http\Request;

class LostBookController extends Controller
{
    public function index()
    {
        $selected = "lost";
        $lost = BorowBook::where('borow_book.status', 2)
            ->orWhere('borow_book.status', 3)
            ->join('users', 'users.id', '=', 'borow_book.user_id')
            ->join('book', 'book.id', '=', 'borow_book.book_id')
            ->select('borow_book.*', 'users.name', 'book.title', 'book.category')
            ->get();
            
        return view('admin.lost_book.index', compact('lost', 'selected'));
    }
    public function setPaid($id)
    {
        $lost = BorowBook::find($id);
        $lost->status = 3;
        $lost->save();
        return response()->json(['success' => 'Lost book is successfully set Paid']);
    }
    public function setBack($id)
    {
        $lost = BorowBook::where('id', $id)->first();
        $lost->delete();
        $book = Books::find($lost->book_id);
        $book->copies = $book->copies + 1;
        $book->save();
        return response()->json(['success' => 'Lost book is successfully set Back']);
    }
}
