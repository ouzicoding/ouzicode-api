<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'thumb' => 'http://img.studemy.com/Resources/jb/2021-03-25/20210325045355At676bXX3e.png',
            'digest'=> $this->faker->text(),
            'content'=> $this->faker->text(),
            'clicks'=> $this->faker->randomNumber(3,true),

        ];
    }
}
