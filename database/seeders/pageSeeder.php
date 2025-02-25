<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('pages')->insert([
            'title' => 'Homepagina',
           'route' => 'index',
           'page_type' => 'index',
           'is_removable' => '0',
           'is_vissible' => '1',
           'is_active' => '1',
           'show_header' => '1',
           'show_footer' => '1',
       ]);
    }
}
