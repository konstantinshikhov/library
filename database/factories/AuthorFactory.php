<?php


namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;


class AuthorFactory extends Factory
{

    protected $model = Author::class;

    public function definition()
    {
       return [
           'name' => $this->faker->name,
           'surname' => $this->faker->lastName,
           'patronymic' => $this->faker->userName
       ];
    }
}
