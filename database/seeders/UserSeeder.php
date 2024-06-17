<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rafael Fabiani',
            'email' => 'rafafabiani1909@gmail.com',
            'password' => Hash::make('asdf1234'),
            'fechaNacimiento' => '2003-09-19',
            'ci' => '9101085'
        ])->assignRole('superAdmin');

        User::create([
            'name' => 'Prueba',
            'email' => 'prueba@prueba.com',
            'password' => Hash::make('prueba'),
            'fechaNacimiento' => '2000-01-01',
            'ci' => '9101010'
        ])->assignRole('usuario');

        User::create([
            'name' => 'Prueba 2',
            'email' => 'otraprueba@prueba.com',
            'password' => Hash::make('prueba'),
            'fechaNacimiento' => '2024-04-27',
            'ci' => '12341234'
        ])->syncRoles(['usuario', 'personal']);

        User::create([
            'name' => 'Prueba 4',
            'email' => 'otrapruebaa@prueba.com',
            'password' => Hash::make('prueba'),
            'fechaNacimiento' => '2024-04-27',
            'ci' => '19203491'
        ])->syncRoles(['usuario']);

        User::create([
            'name' => 'Prueba 3',
            'email' => 'otraprueba2@prueba.com',
            'password' => Hash::make('prueba'),
            'fechaNacimiento' => '2002-02-11',
            'ci' => '910812'
        ])->assignRole('personal')->delete();

        User::factory(100)->create();
    }
}
