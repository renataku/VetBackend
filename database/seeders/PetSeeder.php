<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;
use App\Models\Client;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Eloquent\Collection;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Pet::factory(10)->state(new Sequence(
            fn ($sequence) => [
                'client_id' => Client::all()->random(),
                'breed_id' => Breed::all()->random(),
            ],
        ))->create();
    }
}
