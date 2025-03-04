<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'email' => $this->faker->unique()->safeEmail,
            'tell' => substr($this->faker->phoneNumber, 0, 11),
            'address' => $this->faker->address,
            'building' => $this->faker->optional()->buildingNumber,
            'detail' => substr($this->faker->sentence, 0, 120),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}