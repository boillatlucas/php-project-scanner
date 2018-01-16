<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogLinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<30; $i++){
            DB::table('log_lines')->insert([
                'content' => str_random(1000)
            ]);
        }
    }
}
