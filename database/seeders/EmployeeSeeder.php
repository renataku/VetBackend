<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(4)->state(new Sequence(
            [
                'position' => 'Admin',
                'role_id' => 1,
                'email' => 'admin@admin.admin',
                'password' => Hash::make("admin")
            ],
            [
                'position' => 'VET1',
                'role_id' => 2,
                'email' => 'vet1@vet.vet',
                'password' => Hash::make("vet1vet")
            ],
            [
                'position' => 'VET2',
                'role_id' => 2,
                'email' => 'vet2@vet.vet',
                'password' => Hash::make("vet2vet")
            ],
            [
                'position' => 'VET3',
                'role_id' => 2,
                'email' => 'vet3@vet.vet',
                'password' => Hash::make("vet3vet")
            ],
        ))->create();
    }
}
