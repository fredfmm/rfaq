<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, 20)->create()
            ->each(function($tag) {
                $questionsIds = [];
                for ($i = 0; $i < rand(1, 15); $i++) {
                    $questionsIds[] = Question::inRandomOrder()->first()->id;
                }

                $questionsIds = array_unique($questionsIds);

                $tag->questions()->sync($questionsIds);
            });
    }
}
