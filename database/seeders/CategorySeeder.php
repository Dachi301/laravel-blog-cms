<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sport',
                'slug' => 'sport',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Food & Cooking',
                'slug' => 'food-cooking',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
