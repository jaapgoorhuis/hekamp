<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class blockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('blocks')->insert([
           [
               'block_name' => 'pageText',
               'friendly_name' => 'Tekst blok',
               'table_name' => 'text_block'
           ],
           [
               'block_name' => 'pageImages',
               'friendly_name' => 'Afbeeldingen blok',
               'table_name' => 'image_block'
           ]
       ]);
    }
}
