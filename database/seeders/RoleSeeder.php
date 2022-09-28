<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory(3)->state(new Sequence(
            [
                'title' => 'admin',
                'suitable' => 'employee'
            ],
            [
                'title' => 'vet',
                'suitable' => 'employee'
            ],
            [
                'title' => 'client',
                'suitable' => 'client'
            ]
        ))->create();
    }
}
