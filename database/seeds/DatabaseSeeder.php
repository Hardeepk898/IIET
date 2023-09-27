<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'info@iietsolutions.com',
            'password' => bcrypt('iietSolut10n5@#*'),
            'user_type' => 1
        ]);
    }
}
