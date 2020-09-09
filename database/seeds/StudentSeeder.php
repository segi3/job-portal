<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('students')->insert([
            'status' => '1',
            'name' => 'Student 1',
            'nrp' => '05111840000100',
            'email' => 'student@gmail.com',
            'mobile_no' => '085730105094',
            'password' => Hash::make('student@gmail.com'),
            'hobby' => 'ngoding',
            'achievment' => 'Tidak ada',
            'experience' => 'Pahit',
            'gender' => 'L',
            'address' => 'Jl Sumberboto RT 03 RW 02 Mojoduwur, Mojowarno, Jombang, Jawa TImur, Indonesia',
            'city' => 'Jombang',
            'province' => 'Jawa Timur',
            'berkas_validasi' => 'Student_1_b8aeec8b91548b073d2b7e42f9d1328d.pdf',
            'birthdate' => '2020-09-1',

            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
