<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            99999 => 'admin@admin.com',
        ];

        foreach ($admins as $id => $admin) {
            $admin = User::query()->firstOrCreate([
                'email' => $admin,
            ], [
                'name' => 'Admin',
                'password' => Hash::make('admin'),
            ]);
        }
    }
}
