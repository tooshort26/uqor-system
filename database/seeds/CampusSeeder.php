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
			'email'    => 'cdongayo@gmail.com',
			'name'     => 'Tandag',
            'phone_number' => '09151789072',
			'address'  => 'Tandag City',
			'approved' => 1,
			'password' => 'password'
        ]);
    }
}
