<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert some stuff
        DB::table('roles')->insert([
            [
                'slug' => 'root',
                'name' => 'Root Base'
            ],
            [
                'slug' => 'sadmin',
                'name' => 'Super Admin'
            ],
            [
                'slug' => 'admin',
                'name' => 'Administrator'
            ],
            [
                'slug' => 'manager',
                'name' => 'Manager'
            ],
            [
                'slug' => 'steam',
                'name' => 'Sales Team'
            ],
            [
                'slug' => 'registered',
                'name' => 'Registered'
            ],
            [
                'slug' => 'employee',
                'name' => 'Employee'
            ],
            [
                'slug' => 'operater',
                'name' => 'Operater'
            ]
       ] );
    }
}
