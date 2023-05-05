<?php

namespace App\Models;

class DataLayer
{
    public function listAuthors() {        
        $authors = Author::orderBy('lastname','asc')->orderBy('firstname','asc')->get();
        return $authors;
    }

    public function listBooks() {        
        $books = Book::orderBy('title','asc')->get();
        return $books;
    }

    public function findAuthorById($id) {
        return Author::find($id);
    }

    public function deleteAuthor($id) {
        $author = Author::find($id);
        $author->address->delete();
        $author->delete();
    }

    public function editAuthor($id, $first_name, $last_name) {
        $author = Author::find($id);
        $author->firstname = $first_name;
        $author->lastname = $last_name;
        $author->save();
        // massive update (only with fillable property enabled on Author): 
        // Author::find($id)->update(['firstname' => $first_name, 'lastname' => $last_name]);
    }

    public function addAuthor($first_name, $last_name) {
        $author = new Author;
        $author->firstname = $first_name;
        $author->lastname = $last_name;
        $author->save();

        //use the factory to randomly generate an address
        Address::factory()->count(1)->create(['author_id' => $author->id]);

        // massive creation (only with fillable property enabled on Author):
        // Author::create(['firstname' => $first_name, 'lastname' => $last_name, 'user_id' => $user]);
    }

    public function findBookById($id) {
        return Book::find($id);
    }

    public function deleteBook($id) {
        $book = Book::find($id);
        $categories = $book->categories;
        foreach($categories as $cat) {
            $book->categories()->detach($cat->id);
        }
        $book->delete();
    }

    public function editBook($id, $title, $author_id, $categories) {
        $book = Book::find($id);
        $book->title = $title;
        $book->author_id = $author_id;
        $book->save();

        // Cancel the previous list of categories
        $prevCategories = $book->categories;
        foreach($prevCategories as $prevCat) {
            $book->categories()->detach($prevCat->id);
        }

        // Update the list of categories
        foreach($categories as $cat) {
            $book->categories()->attach($cat);
        }
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }

    public function addBook($title, $author_id, $categories) {
        $book = new Book;
        $book->title = $title;
        $book->author_id = $author_id;
        $book->save();
        foreach($categories as $cat) {
            $book->categories()->attach($cat);
        }
        // massive creation (only with fillable property enabled on Book):
        // Book::create(['title' => $title, 'author_id' => $author_id, 'user_id' => $user]);
    }

    public function getAllCategories() {
        return Category::orderBy('name','asc')->get();
    }
}