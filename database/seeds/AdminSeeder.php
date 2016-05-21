<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class AdminSeeder extends Seeder {

    public function run(){
        Model::unguard();
        $user = [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'admin' => 1];
        $db = DB::table('users')->insert($user);
    }

}