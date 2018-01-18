<?php

use Carbon\Carbon;
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
        for($i=0; $i<20; $i++){
            DB::table('logs')->insert([
                'title' => str_random(10),
                'status' => self::EXAMPLES_STATUS[rand(0,8)],
                'project_id' => rand(1,3),
                'log_type_id' => rand(1,4),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
