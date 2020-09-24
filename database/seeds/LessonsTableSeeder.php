<?php

use Faker\Factory as Faker;
use App\Lesson;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder {

    /**
     * 
     * @see https://github.com/fzaninotto/Faker
     *
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 30) as $index)
        {
            Lesson::create([
                'title' => $faker->sentence(5),
                'body' => $faker->paragraph(4),
                'active' => $faker->boolean(50)
            ]);
        }
    }
}