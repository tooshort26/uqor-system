<?php

use App\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campus::create([
			'email'    => 'campus@yahoo.com',
			'name'     => 'Campus Doe',
			'address'  => 'Tandag City',
			'approved' => 1,
			'password' => bcrypt('password')
        ]);
    }
}
