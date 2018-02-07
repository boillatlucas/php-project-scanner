<?php

use Carbon\Carbon;
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
                'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dictum dolor ac odio faucibus elementum. Nam pellentesque mollis augue vel bibendum. Donec pharetra felis in ipsum iaculis finibus. Ut at metus velit. Nullam vel nisi et ante mollis vestibulum vitae ac nisi. Nam lobortis massa posuere mi porta, eget dapibus lectus hendrerit. Etiam lacinia aliquam efficitur.",
                'log_id' => rand(1,20)
            ]);
        }
    }
}
