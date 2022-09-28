<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Pet;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            SpeciesSeeder::class,
            BreedSeeder::class,
            ClientSeeder::class,
            EmployeeSeeder::class,
            PetSeeder::class,
        ]);
    }
}
