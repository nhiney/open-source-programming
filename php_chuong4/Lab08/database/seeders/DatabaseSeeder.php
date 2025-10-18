<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Category::factory()
            ->count(5)
            ->hasProducts(10)
            ->create();
        $this->call(StudentCourseSeeder::class);
        $this->call(UserProfileSeeder::class);
    }
}
