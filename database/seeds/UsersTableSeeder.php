<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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

        $adminRole = Role::create(['name'=>'Admin', 'display_name'=>'Administrador']);
        $sellerRole = Role::create(['name'=>'Seller','display_name'=>'Vendedor']);

        //permisos
        Permission::create(['name'=>'View users','display_name'=>'Ver usuarios']);
        Permission::create(['name'=>'Create users','display_name'=>'Crear usuarios']);
        Permission::create(['name'=>'Update users','display_name'=>'Actualizar usuarios']);
        Permission::create(['name'=>'Delete users','display_name'=>'Borrar usuarios']);

        Permission::create(['name'=>'Update roles','display_name'=>'Actualizar roles']);

        
        $admin = new User;
        $admin->name="Cituk Caamal 1";
        $admin->email='citukcaamal@gmail.com';
        $admin->password='wKyh5vfL3SM5eTn';
        $admin->save();

        $admin->assignRole($adminRole);// le asignamos el rol de admin

        $seller = new User;
        $seller->name="Cituk Caamal 2";
        $seller->email='citukcaamal1@gmail.com';
        $seller->password='tXy3eEp9z4TbqnG';
        $seller->save();

        $seller->assignRole($sellerRole);// le asignamos el rol de vendedor 


        $user = new User;
        $user->name="Cituk Caamal 3";
        $user->email='citukcaamal2@gmail.com';
        $user->password='tXy3eEp9z4TbqnG';
        $user->save();
    }
}
