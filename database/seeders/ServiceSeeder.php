<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Service;
use App\Models\Employee;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::factory(2)->state(new Sequence(
            fn ($sequence) => [
                'employee_id' => Employee::where('id', '>', 1)->get()->random(),
            ],
        ))->create();
    }
}
