<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogTypesTableSeeder extends Seeder
{
    const EXAMPLES_TYPES = array('Fixers','Metrics','Vulnerability','Linter');

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::EXAMPLES_TYPES as $type){
            DB::table('log_types')->insert([
                'type' => $type
            ]);
        }
    }
}
