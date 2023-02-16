<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Country;
use App\Models\Profession;
use App\Models\Salary;
use Database\Factories\PostFactory;
use Database\Factories\PostTranslationFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        PostFactory::new()->count(10)->create();
//        Profession::factory(100)->create();

//        Country::factory(7)->create();
//        Salary::factory(7)->create();

//        Category::factory(5)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


//        $this->call(
//            [
//                PostDatabaseSeeder::class,
//                PostTranslationFactory::class,
//            ]
//        );
    }
}
