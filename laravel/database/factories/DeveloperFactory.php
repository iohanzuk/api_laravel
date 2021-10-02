<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeveloperFactory extends Factory
{
    protected $model = Developer::class;

    public function definition()
    {
        $birtDay = $this->faker->date(["Y-m-d", "now"]);
        $age = Carbon::parse($birtDay)->age;
        return [
            'nome' => $this->faker->name(),
            'sexo' => $this->faker->randomElement(['M','F', 'O']),
            'idade' => $age,
            'datanascimento' => $birtDay,
            'hobby' => $this->faker->colorName()
        ];
    }
}
