<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'film_id' => 1,
            'user_id' => 1,
            'comments' => 'This movie is very good. Recommended!',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('comments')->insert([
            'film_id' => 2,
            'user_id' => 1,
            'comments' => 'I watch this because emma watson <3',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('comments')->insert([
            'film_id' => 3,
            'user_id' => 1,
            'comments' => 'Very exciting movie!!',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
