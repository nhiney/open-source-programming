<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class UserProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 5 user, mỗi user có 1 profile
        User::factory()->count(5)->create()->each(function ($user) {
            $user->profile()->create([
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
                'birthday' => fake()->date(),
                'bio' => fake()->sentence(),
            ]);
        });

        // Tùy chọn: tạo 1 user cụ thể
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->profile()->create([
            'address' => '123 Lê Lợi, Q1',
            'phone' => '0909123456',
            'birthday' => '2000-01-01',
            'bio' => 'Sinh viên PHP',
        ]);
    }
}
