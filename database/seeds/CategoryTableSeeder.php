<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        \DB::table('categories')->insertGetId([
            'namaKategori' => $faker->word,
        ]);
    }
}
