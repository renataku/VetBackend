<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Sequence;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Breed::factory(15)->state(new Sequence(
            [
                'name' => 'mix',
                'species_id' =>  1
            ],
            [
                'name' => 'mix',
                'species_id' =>  2
            ],
            [
                'name' => 'Abyssinian ',
                'species_id' => 2
            ],
            [
                'name' => 'Bengal',
                'species_id' => 2
            ],
            [
                'name' => 'Bombay',
                'species_id' => 2
            ],
            [
                'name' => 'Oriental',
                'species_id' => 2
            ],
            [
                'name' => 'Sphynx',
                'species_id' => 2
            ],
            [
                'name' => 'Siamese',
                'species_id' => 2
            ],
            [
                'name' => 'golden retriever ',
                'species_id' => 1
            ],
            [
                'name' => 'labrador retriever',
                'species_id' => 1
            ],
            [
                'name' => 'french bulldog',
                'species_id' => 1
            ],
            [
                'name' => 'beagle',
                'species_id' => 1
            ],
            [
                'name' => 'german shepherd',
                'species_id' => 1
            ],
            [
                'name' => 'poodle',
                'species_id' => 1
            ],
            [
                'name' => 'bulldog',
                'species_id' => 1
            ],
        ))->create();
    }
}
