<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'mobile_no' => '085730105094',
            'password' => Hash::make('admin@gmail.com'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
