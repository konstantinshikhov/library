<?php

namespace Database\Seeders;

use App\Models\Author;
use Database\Factories\AuthorFactory;
use Database\Factories\BookFactory;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::factory(500)->has(Book::factory()->count(3))->create();
//        Author::factory(50)->create()->each(function($foo){
//           $foo->books()->save(Book::factory())->make());
//        });
    }
}
