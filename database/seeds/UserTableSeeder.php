<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        \DB::table('users')->insert([
            'name' => 'Idza Runianti',
            'username' => 'idzarunianti',
            'password' => \Illuminate\Support\Facades\Crypt::encrypt('test'),
        ]);
    }
}
