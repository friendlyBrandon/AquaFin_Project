<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Material;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $this->call([
            MaterialListSeeder::class,
                FloodMaterialSeeder::class,
        ]);
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Gwen',
            'fullname' => 'Wick',
            'username' => 'Gwen.Wick',
            'password' => Hash::make('testtest'),
            'is_admin' => '1',
            'provincie' => 'Antwerpen'
        ]);

        User::factory()->create([
            'name' => 'stock',
            'fullname' => 'medewerker',
            'username' => 'stock.medewerker',
            'password' => Hash::make('wachtwoord'),
            'is_stockMedewerker' => '1',
            'provincie' => 'Antwerpen'
        ]);

    }
}
