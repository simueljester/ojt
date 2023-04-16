<?php

namespace App\Http\Controllers;

use Auth;
use App\Book;
use App\User;
use App\BookAssignment;
use Illuminate\Http\Request;

class BookAssignmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $books = Book::whereArchivedAt(null)->get();
        $users = User::whereRole('student')->get();
        return view('assignments.index',compact('books','users'));
    }

    public function assign(Request $request){

        $books = $request->books;
        $users = $request->users;
        // dd($books);
        //validation checking
        $get_records = BookAssignment::where('user_id',$users)->get()->keyBy('book_id')->toArray();
        $is_existing = 0;
        foreach($books as $book){
            try{
                $is_existing = $get_records[$book] ? 1: 0;
                if($is_existing == 1){
                    return redirect()->back()->with('error','Please check your assignments. Some records are already existing');
                }
            }
            catch (\Exception $e){
                foreach($users as $user){
                    foreach($books as $book){
                        $data[] = [
                            'book_id'           => $book,
                            'user_id'           => $user,
                            'assigned_by_id'    => Auth::user()->id,
                            'created_at'        => now(),
                            'updated_at'        => now()
                        ];
                    }
                    
                }
                BookAssignment::insert($data);
                return redirect()->back()->with('success','Books successfully assigned');
            }
        }



    
        
   
    }

}
