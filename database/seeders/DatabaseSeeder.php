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
        ]);
         User::factory(10)->create();

        User::factory()->create([
            'name' => 'Gwen',
            'fullname' => 'Wick',
            'username' => 'Gwen.Wick',
            'password' => 'testtest',
            'is_admin' => '1',
            'provincie' => 'Antwerpen'
        ]);
      
    }
}
