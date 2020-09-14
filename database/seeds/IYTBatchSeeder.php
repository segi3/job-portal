<?php

use Illuminate\Database\Seeder;

class IYTBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('i_y_t_batches')->insert([
            'IYTname' => 'ITS 1',
            'batch' => '1',
            'start_date' => '2020-09-02',
            'end_date' => '2020-09-03',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('i_y_t_batches')->insert([
            'IYTname' => 'ITS 2',
            'batch' => '2',
            'start_date' => '2020-09-04',
            'end_date' => '2020-09-04',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('i_y_t_batches')->insert([
            'IYTname' => 'ITS 3',
            'batch' => '3',
            'start_date' => '2020-09-04',
            'end_date' => '2020-09-06',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('i_y_t_batches')->insert([
            'IYTname' => 'ITS 4',
            'batch' => '4',
            'start_date' => '2020-09-05',
            'end_date' => '2020-09-07',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
