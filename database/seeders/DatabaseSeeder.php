<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Address;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->populateDB();
    }

    private function populateDB()
    {

        Author::factory()->count(100)->create()->each(function ($author) {
            Address::factory()->count(1)->create(['author_id' => $author->id]);
        });

        $authors_list = json_decode(Author::all());
        for ($i = 0; $i < 50; $i++) {
            $author = $authors_list[array_rand($authors_list)];
            Book::factory()->count(1)->create(['author_id' => $author->id]);
        }

        $CategoryOptions = ['Biografia','Cronaca','Epica','Erotico','Fantascienza',
        'Fantasy','Giallo','Gotico','Orrore','Poesie','Saggio','Sentimentale']; 
        foreach($CategoryOptions as $option)
        {
            Category::create(['name' => $option]);
        }

        $categories_list = json_decode(Category::all());
        $books_list = json_decode(Book::all());

        foreach ($books_list as $book)
        {
            for ($j=0; $j < 3; $j++) {
                // randomly select a category
                $category = $categories_list[array_rand($categories_list)];
                DB::table('book_category')->insert(['book_id' => $book->id, 'category_id' => $category->id]);
            }
        }


    }
}
