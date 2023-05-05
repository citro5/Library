<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $authors = $dl->listAuthors();
        return view('author.authors')->with("authors_list",$authors);
    }

    public function create()
    {
        return view('author.editAuthor');
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->addAuthor($request->input('firstName'),$request->input('lastName'));
        return Redirect::to(route('author.index'));
    }

    public function show() {
        // NOT USED
    }

    public function edit($id) {
        $dl = new DataLayer();
        $author = $dl->findAuthorById($id);

        return view('author.editAuthor')->with('author',$author);
    }

    public function update(Request $request, $id) {
        $dl = new DataLayer();
        $dl->editAuthor($id, $request->input('firstName'), $request->input('lastName'));
        return Redirect::to(route('author.index'));
    }

    public function destroy($id) {
        $dl = new DataLayer();
        $author = $dl->findAuthorById($id);
        if ($author !== null) {
            $dl->deleteAuthor($id);
            return Redirect::to(route('author.index'));
        } else {
            return view('author.deleteErrorPage');
        }
    }

    public function confirmDestroy($id) {
        $dl = new DataLayer();
        $author = $dl->findAuthorById($id);
        if ($author !== null) {
            return view('author.deleteAuthor')->with('author', $author);
        } else {
            return view('author.deleteErrorPage');
        }
    }
}
