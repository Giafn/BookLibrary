<?php

namespace App\Http\Controllers;

use App\Models\BorowBook;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $selected = 'member';
        $member = User::where('is_admin', null)->get();
        return view('admin.member.index', compact('member', 'selected'));
    }
    public function addMember(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $member = new User();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->save();
        return redirect()->route('admin.member')->with('success', 'Member berhasil ditambahkan');
    }

    public function editMember($id)
    {
        $member = User::find($id);
        return response()->json($member);
    }

    public function updateMember(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'password' => 'nullable|min:8'
        ]);
        $id = $request->id;
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $member = User::find($id);
        $member->name = $request->name;
        if ($request->password) {
            $member->password = bcrypt($request->password);
        }
        $member->save();
        return redirect()->route('admin.member')->with('success', 'Member berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $borrow = BorowBook::where('user_id', $id)->get();
        if (count($borrow) > 0) {
            return redirect()->route('admin.member')->with('error', 'Member tidak bisa dihapus karena masih meminjam buku');
        }
        $member = User::find($id);
        $member->delete();
        return redirect()->route('admin.member')->with('success', 'Member berhasil dihapus');
    }
}
