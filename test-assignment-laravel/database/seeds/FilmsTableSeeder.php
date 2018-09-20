<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([
            'id' => 1,
            'name' => 'The Dark Tower',
            'slug' => str_slug('The Dark Tower', '-'),
            'description' => "Roland Deschain (Idris Elba), the last Gunslinger, is locked in an eternal battle with Walter O'Dim (Matthew McConaughey), also known as the Man in Black. The Gunslinger must prevent the Man in Black from toppling the Dark Tower, the key that holds the universe together. With the fate of worlds at stake, two men collide in the ultimate battle between good and evil.",
            'rating' => 3,
            'ticket_price' => 50000,
            'release_date' => '2017-08-12',
            'photo' => 'film1.jpg',
            'created_by' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('films')->insert([
            'id' => 2,
            'name' => 'Beauty and the Beast',
            'slug' => str_slug('Beauty and the Beast', '-'),
            'description' => "An arrogant young prince (Robby Benson) and his castle's servants fall under the spell of a wicked enchantress, who turns him into the hideous Beast until he learns to love and be loved in return. The spirited, headstrong village girl Belle (Paige O'Hara) enters the Beast's castle after he imprisons her father Maurice (Rex Everhart). With the help of his enchanted servants, including the matronly Mrs. Potts (Angela Lansbury), Belle begins to draw the cold-hearted Beast out of his isolation.",
            'rating' => 4,
            'ticket_price' => 60000,
            'release_date' => '2017-08-12',
            'photo' => 'film2.jpg',
            'created_by' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('films')->insert([
            'id' => 3,
            'name' => 'Dunkirk',
            'slug' => str_slug('Dunkirk', '-'),
            'description' => "In May 1940, Germany advanced into France, trapping Allied troops on the beaches of Dunkirk. Under air and ground cover from British and French forces, troops were slowly and methodically evacuated from the beach using every serviceable naval and civilian vessel that could be found. At the end of this heroic mission, 330,000 French, British, Belgian and Dutch soldiers were safely evacuated.",
            'rating' => 5,
            'ticket_price' => 60000,
            'release_date' => '2017-08-12',
            'photo' => 'film3.jpg',
            'created_by' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('films_genres')->insert([
            'film_id' => 1,
            'genre_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('films_genres')->insert([
            'film_id' => 1,
            'genre_id' => 4,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('films_genres')->insert([
            'film_id' => 2,
            'genre_id' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('films_genres')->insert([
            'film_id' => 3,
            'genre_id' => 4,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('films_genres')->insert([
            'film_id' => 3,
            'genre_id' => 5,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
