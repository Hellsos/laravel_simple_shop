<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $user = [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'admin' => 1];
        $db = DB::table('users')->insert($user);
              
    }
}
