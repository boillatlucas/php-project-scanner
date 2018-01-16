<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectsTableSeeder::class);
        $this->call(LogTypesTableSeeder::class);
        $this->call(LogsTableSeeder::class);
        $this->call(LogLinesTableSeeder::class);
    }
}
