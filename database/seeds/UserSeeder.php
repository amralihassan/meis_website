<?php

use Illuminate\Database\Seeder;
use App\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
           'name' => 'Admin',
           'email' => 'admin@domain.com',
           'password' => bcrypt('123')
        ]);
    }
}
