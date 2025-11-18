<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $users = User::whereHas('role', function($query){
            $query->where('role_name', "=", "member");
        })->get();
        $borrows = Borrow::with(['book', 'user'])->get();
        $isAdmin = (Auth::check() && Auth::user()->hasRole('admin'));
        return view("borrow.index", compact('users','books','borrows','isAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!(Auth::check() && Auth::user()->hasRole('admin'))) {
            return redirect('/admin/borrow')->with('error', 'Only admin can add borrow data!');
        }
        $request->validate([
            'book_id'=> 'required|exists:books,id',
            'user_id'=> 'required|exists:users,id',
            'qty'=> 'required|digits_between:1,2',
            'start_borrow'=> 'required|date',
            'end_borrow'=> 'nullable|date',
        ]);

        $endInput = $request->input('end_borrow');
        if (empty($endInput) || strtotime($endInput) === false) {
            $endBorrow = date('Y-m-d', strtotime($request->start_borrow . ' +3 days'));
        } else {
            $endBorrow = $endInput;
        }

        Borrow::create([
            'book_id'=> $request->book_id,
            'user_id'=> $request->user_id,
            'qty'=> $request->qty,
            'start_borrow'=> $request->start_borrow,
            'end_borrow'=> $endBorrow,
            'fine' => 0,
        ]);
        return redirect("/admin/borrow")->with("success","Borrow data has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!(Auth::check() && Auth::user()->hasRole('admin'))) {
            return redirect('/admin/borrow')->with('error', 'Only admin can view borrow data!');
        }

        $borrow = Borrow::with(['book', 'user'])->findOrFail($id);
        $books = Book::all();
        $users = User::whereHas('role', function($query){
            $query->where('role_name', "=", "member");
        })->get();
        return view('borrow.edit', compact('borrow', 'books', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!(Auth::check() && Auth::user()->hasRole('admin'))) {
            return redirect('/admin/borrow')->with('error', 'Only admin can update borrow data!');
        }
        $request->validate([
            'book_id'=> 'required|exists:books,id',
            'user_id'=> 'required|exists:users,id',
            'qty'=> 'required|digits_between:1,2',
            'start_borrow'=> 'required|date',
            'end_borrow'=> 'nullable|date',
        ]);

        // Compute end_borrow if missing or invalid
        $endInput = $request->input('end_borrow');
        if (empty($endInput) || strtotime($endInput) === false) {
            $endBorrow = date('Y-m-d', strtotime($request->start_borrow . ' +3 days'));
        } else {
            $endBorrow = $endInput;
        }

        $borrow = Borrow::findOrFail($id);
        $borrow->book_id = $request->book_id;
        $borrow->user_id = $request->user_id;
        $borrow->qty = $request->qty;
        $borrow->start_borrow = $request->start_borrow;
        $borrow->end_borrow = $endBorrow;
        $borrow->save();

        return redirect('/admin/borrow')->with('success', 'Borrow data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!(Auth::check() && Auth::user()->hasRole('admin'))) {
            return redirect('/admin/borrow')->with('error', 'Only admin can delete borrow data!');
        }
        $borrow = Borrow::findOrFail($id);
        $borrow->delete();
        return redirect('/admin/borrow')->with('success', 'Borrow data has been deleted!');
    }
}
