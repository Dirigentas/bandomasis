<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Aras',
            'email' => 'admin.@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'administratorius'
        ]);
        DB::table('users')->insert([
            'name' => 'Marius',
            'email' => 'a@a',
            'password' => Hash::make('123'),
        ]);
        DB::table('restaurants')->insert([
            'name' => 'Hesburger',
            'city' => 'Vilnius',
            'address' => 'Minties g.',
            'start' => '11:00',
            'end' => '23:00',
        ]);
        DB::table('restaurants')->insert([
            'name' => 'London grill',
            'city' => 'Kaunas',
            'address' => 'Gostauto g.',
            'start' => '10:00',
            'end' => '22:00',            
        ]);
        DB::table('dishes')->insert([
            'restaurant' => 'Hesburger',
            'name' => 'Tortilija',
            'price' => '5',
        ]);
        DB::table('dishes')->insert([
            'restaurant' => 'Hesburger',
            'name' => 'pica',
            'price' => '10',
        ]);
        DB::table('dishes')->insert([
            'restaurant' => 'London grill',
            'name' => 'Hamburgeris',
            'price' => '15',
        ]);
    }
}
?>