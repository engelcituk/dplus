<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = new User;
        $user->name="Cituk Caamal 1";
        $user->email='citukcaamal@gmail.com';
        $user->password=bcrypt('wKyh5vfL3SM5eTn');
        $user->save();
       
        $user = new User;
        $user->name="Cituk Caamal 2";
        $user->email='citukcaamal1@gmail.com';
        $user->password=bcrypt('tXy3eEp9z4TbqnG');
        $user->save();

        $user = new User;
        $user->name="Cituk Caamal 3";
        $user->email='citukcaamal2@gmail.com';
        $user->password=bcrypt('tXy3eEp9z4TbqnG');
        $user->save();
    }
}
