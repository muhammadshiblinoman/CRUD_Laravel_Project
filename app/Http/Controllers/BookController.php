<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;


class BookController extends Controller {
    public function welcome(){
        return view("welcome");
    }
    public function index(){
        // fetch books data from books table
        $books = Book::paginate(10);
        // dd($books);

        // Logic to retrieve and display books
        return view('books.index')->with('books', $books);
    }

    public function show($id){
        // echo "Book ID: " . $id;

        $book = Book::find($id);
        return view('books.show')->with('book', $book);
    }

    public function create(){
        return view('books.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price'  => 'required|numeric|min:0',
            'quantity'  => 'required|integer|min:1',
            'isbn' => 'required|numeric|digits:13',
        ]);

        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book->isbn = $request->isbn;

        $book->save();

        return redirect()->route('books.show', $book->id);
        // return $request->all();
    }
    public function edit($id) {
        $book = Book::find($id);
        return view('books.edit')->with('book', $book);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price'  => 'required|numeric|min:0',
            'quantity'  => 'required|integer|min:1',
            'isbn' => 'required|numeric|digits:13',
        ]);

        $book = Book::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book->isbn = $request->isbn;

        $book->save();

        return redirect()->route('books.show', $book->id);
    }

    public function destroy(Request $request) {
        $book = Book::find($request->id);
        $book->delete();

        return redirect()->route('books.index');
    }

}
