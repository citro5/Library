<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    //protected $primaryKey = 'alter_field_as_primary_key';
    //use SoftDeletes;
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['title', 'author_id'];

    // Method of Book model
    public function categories()
    {
        // the property $book->categories returns an array of Category
        return $this->belongsToMany(Category::class,'book_category','book_id','category_id');
    }

    public function author()
    {
        // the property $book->author returns an object of type Author
        return $this->belongsTo(Author::class,'author_id','id');
    }
}
