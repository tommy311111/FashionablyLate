<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;


class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        $faker = FakerFactory::create('ja_JP');

        return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement(['male', 'female', 'other']),
        'email' => $faker->unique()->safeEmail,
        'tell' => $faker->randomElement(['070', '080', '090']) . $faker->numerify('#######'),
        'address' => $faker->address,
        'building' => $faker->optional(0.5)->buildingNumber,
        'detail' => $faker->sentence(15), 
        'category_id' => Category::exists()
    ? Category::query()->inRandomOrder()->value('id')
    : Category::factory()->create()->id,

        ];
    }
}