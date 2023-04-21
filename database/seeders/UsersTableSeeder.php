<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tạo 1 bản ghi cụ thể
            // DB::table('users')->insert([
            //     'name' => 'meomeo',
            //     'email' => 'meomeo@gmail.com',
            //     'email_verified_at' => now(),
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            // ]);

            // User::factory()->create([
            //     'name' => 'meomeo2',
            //     'email' => 'meomeo2@gmail.com',
            //     'email_verified_at' => now(),
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            // ]);

            // User::factory()->suspended()->create();
        
        //tạo đồng loạt nhiều record
            // User::factory(10)->create();


            //hỏi số lượng trước khi tạo
            $usersCount = max((int) $this->command->ask('How many users do you want to create?', 10), 1);  //set default = 10
            User::factory($usersCount)->create();
    }
}
