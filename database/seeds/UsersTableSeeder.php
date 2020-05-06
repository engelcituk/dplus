<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        User::truncate();

        $adminRole = Role::create(['name'=>'Admin']);
        $sellerRole = Role::create(['name'=>'Seller ']);

        
        $admin = new User;
        $admin->name="Cituk Caamal 1";
        $admin->email='citukcaamal@gmail.com';
        $admin->password=bcrypt('wKyh5vfL3SM5eTn');
        $admin->save();

        $admin->assignRole($adminRole);// le asignamos el rol de admin

        $seller = new User;
        $seller->name="Cituk Caamal 2";
        $seller->email='citukcaamal1@gmail.com';
        $seller->password=bcrypt('tXy3eEp9z4TbqnG');
        $seller->save();

        $seller->assignRole($sellerRole);// le asignamos el rol de vendedor 


        $user = new User;
        $user->name="Cituk Caamal 3";
        $user->email='citukcaamal2@gmail.com';
        $user->password=bcrypt('tXy3eEp9z4TbqnG');
        $user->save();
    }
}
