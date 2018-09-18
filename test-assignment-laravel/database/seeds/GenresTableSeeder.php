<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'id' => 1,
            'name' => 'Horror',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('genres')->insert([
            'id' => 2,
            'name' => 'Drama',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('genres')->insert([
            'id' => 3,
            'name' => 'Romance',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('genres')->insert([
            'id' => 4,
            'name' => 'Comedy',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('genres')->insert([
            'id' => 5,
            'name' => 'Thriller',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
