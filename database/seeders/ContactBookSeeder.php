<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ContactBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $faker = Faker::create();

      foreach (range(1, 50) as $index) {
          DB::table('contact_books')->insert([
              'id' => $faker->uuid,
              'name' => $faker->name,
              'email' => $faker->unique()->safeEmail,
              'phone' => $faker->phoneNumber,
              'address' => $faker->address,
              'created_at' => now(),
              'updated_at' => now(),
              'user_id' => 1,
          ]);
      }
    }
}
