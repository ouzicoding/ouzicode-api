<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>$this->faker->randomNumber(3,true),
            'article_id'=>$this->faker->randomNumber(3,true),
            'parent_id'=>$this->faker->randomNumber(3,true),
            'content'=>$this->faker->text(),
            'is_deleted'=>0,

        ];
    }
}
