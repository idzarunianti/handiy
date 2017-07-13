<?php

use Illuminate\Database\Seeder;

class TutorialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        $tutorial = \DB::table('tutorials')->insertGetId([
            'title' => $faker->sentence,
            'tutorial' => $faker->paragraph,
            'category_id' => 1,
        ]);
        \DB::table('photo_tutorials')->insert([
            'tutorial_id' => $tutorial,
            'photo' => 'http://abcd/',
        ]);
    }
}
