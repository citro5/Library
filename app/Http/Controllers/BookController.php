<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $books = $dl->listBooks();
        return view('book.books')->with('books_list',$books);
    }

    public function create()
    {
        $dl = new DataLayer();
        $authors_list = $dl->listAuthors();
        $categories = $dl->getAllCategories();

        return view('book.editBook')->with('authorList', $authors_list)->with('categories',$categories);
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->addBook($request->input('title'), $request->input('author_id'), $request->input('category_id'));

        return Redirect::to(route('book.index'));
    }

    public function show()
    {
        // NOT USED 
    }

    public function edit($id)
    {
        $dl = new DataLayer();
        $authors_list = $dl->listAuthors();
        $book = $dl->findBookById($id);
        $categories = $dl->getAllCategories();

        return view('book.editBook')->with('authorList', $authors_list)->with('book', $book)->with('categories',$categories);
    }

    public function update(Request $request, $id)
    {
        $dl = new DataLayer();
        $dl->editBook($id, $request->input('title'), $request->input('author_id'), $request->input('category_id'));
        return Redirect::to(route('book.index'));
    }

    public function destroy($id)
    {
        $dl = new DataLayer();
        $book = $dl->findBookById($id);
        if ($book !== null) {
            $dl->deleteBook($id);
            return Redirect::to(route('book.index'));
        } else {
            return view('book.deleteErrorPage');
        }
        
    }

    public function confirmDestroy($id)
    {
        $dl = new DataLayer();
        $book = $dl->findBookById($id);
        if ($book !== null) {
            return view('book.deleteBook')->with('book', $book);
        } else {
            return view('book.deleteErrorPage');
        }
    }
}
