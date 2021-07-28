<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdministratorFactory extends Factory
{


    protected $model=Administrator::class;

    public function definition()
    {
        return [
            'account'=>'',
            'nickname'=>'',
            'last_login_ip'=>'',
        ];
    }




}
