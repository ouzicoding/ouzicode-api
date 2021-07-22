<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{


    protected $model = Article::class;

    public function definition()
    {

        return [
            'title'=>$this->faker->name(),
            'thumb'=>'',
            'digest'=>'',
            'content'=>'',
            'status'=>0,
            'is_released'=>0,
        ];
    }

}
