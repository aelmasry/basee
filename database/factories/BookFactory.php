<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_en' => $this->faker->word,
        'brief_en' => $this->faker->text,
        'name_ar' => $this->faker->word,
        'brief_ar' => $this->faker->text,
        'type' => $this->faker->word,
        'duration' => $this->faker->randomDigitNotNull,
        'author_id' => $this->faker->word,
        'narrator_id' => $this->faker->word,
        'category_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
