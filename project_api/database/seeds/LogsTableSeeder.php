<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogsTableSeeder extends Seeder
{
    const EXAMPLES_STATUS = array(1,0,'60%','10%','0%','100%','OK','FAILED',null);

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert([
            'title' => str_random(10),
            'status' => self::EXAMPLES_STATUS[rand(0,8)]
        ]);
    }
}
