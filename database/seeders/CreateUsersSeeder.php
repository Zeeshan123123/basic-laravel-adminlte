<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'Admin',
                'email'=>'admin@email.com',
                'password'=> bcrypt('admin123'),
            ],
            [
                'name'=>'Test User',
                'email'=>'testuser@affordit.co.nz',
                'password'=> bcrypt('zeeshan123'),
            ],
        ];

        if (User::count() < 1) {
            foreach ($user as $key => $value) {
                User::create($value);
            }
        }
        
    }
}
