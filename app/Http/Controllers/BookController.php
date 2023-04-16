<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('books.create');
    }

    public function list(){
        $books = Book::whereDeletedAt(null)->get();
        return $books;
    }

    public function save(Request $request){
        $book = New Book;
        $book->title        = $request->title;
        $book->description  = $request->description;
        $book->save();
        return 'success';
        // return redirect()->route('whome')->with('success', 'Book successfully updated');
    }

    
    public function edit(Book $book){
        return view('books.edit',compact('book'));
    }

    public function update(Request $request){
        Book::find($request->id_edit)->update([
            'title' => $request->title_edit, 
            'description' => $request->description_edit
        ]);
        return 'success';
    }

    public function delete(Request $request){
        $book = Book::find($request->delete_id);
        $book->delete();
        return 'success';
    }
}
