<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Platform Admin',
            'email' => 'admin@989coupons.com',
            'password' => bcrypt('temp1234'),
        ]);
    }
}
