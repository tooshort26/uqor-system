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
			'email'    => 'christophervistal26@gmail.com',
			'name'     => 'Campus Doe',
            'phone_number' => '09193693499',
			'address'  => 'Tandag City',
			'approved' => 1,
			'password' => 'password'
        ]);
    }
}
