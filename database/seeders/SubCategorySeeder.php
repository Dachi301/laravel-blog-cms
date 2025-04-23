<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->pluck('id', 'name'); // Get ID by category name

        $subCategories = [
            'Sport' => ['UFC', 'Football', 'Basketball'],
            'Technology' => ['Artificial Intelligence', 'Programming'],
            'Electronics' => ['Computers', 'Smartphones', 'Laptops']
        ];

        foreach ($subCategories as $categoryName => $subs) {
            $categoryId = $categories[$categoryName] ?? null;
            if ($categoryId) {
                foreach ($subs as $sub) {
                    SubCategory::updateOrCreate(
                        [
                            'name' => $sub,
                            'category_id' => $categoryId
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                }
            }
        }
    }
}
