<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');
    }
}
