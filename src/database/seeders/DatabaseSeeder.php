<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
       $this->call(CategoriesTableSeeder::class);
       
        if (Category::count() === 0) {
            return;
        }

        foreach (range(1, 7) as $i) {
            Contact::factory(5)->create();
        }


    }

}