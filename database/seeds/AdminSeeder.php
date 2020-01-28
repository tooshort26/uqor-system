<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
			'name'     => 'Administrator Admin',
			'email'    => 'admin@yahoo.com',
			'password' => bcrypt('password'),
        ]);
    }
}
