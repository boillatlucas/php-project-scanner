<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'slug' => str_random(10),
            'email' => 'd.sandron@it-akademy.fr',
            'repository_url' => "https://github.com/dimsand/new-portfolio",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('projects')->insert([
            'slug' => str_random(10),
            'email' => 'd.sandron@it-akademy.fr',
            'repository_url' => "https://github.com/dimsand/API-Moodify",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('projects')->insert([
            'slug' => str_random(10),
            'email' => 'd.sandron@it-akademy.fr',
            'repository_url' => "https://github.com/dimsand/Bataille-Navale-Multijoueur",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
