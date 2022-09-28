<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory(1)->create([
            'email' => "client@client.client",
            'password' => Hash::make('client')
        ]);

        Client::factory(3)->create([
            'password' => Hash::make('password')
        ]);
    }
}
