<?php


namespace Database\Factories;


use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

    protected $model = Book::class;

    public function definition()
    {
        return [
            'name'        => $this->faker->title,
            'description' => $this->faker->text(30),
            'publish_at'  => $this->faker->dateTime,
            'image'       => $this->faker->text(5),
        ];
    }
}
