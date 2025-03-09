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

        // カテゴリーが存在しない場合は終了
        if (Category::count() === 0) {
            return;
        }

        // メモリ対策で5件ずつ (合計35件) 作成
        foreach (range(1, 7) as $i) {
            Contact::factory(5)->create();
        }


    }

}