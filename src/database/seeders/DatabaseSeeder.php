<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        Contact::truncate();

        Contact::factory(35)->make()->each(function ($contact) use ($categories) {
            $contact->category_id = $categories->random()->id;
            $contact->save();
        });
    }

}