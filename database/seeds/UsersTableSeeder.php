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

        Permission::create(['name'=>'View categories','display_name'=>'Ver categorias']);
        Permission::create(['name'=>'Create categories','display_name'=>'Crear categorias']);
        Permission::create(['name'=>'Update categories','display_name'=>'Actualizar categorias']);
        Permission::create(['name'=>'Delete categories','display_name'=>'Borrar categorias']);

        //permisos
        Permission::create(['name'=>'View users','display_name'=>'Ver usuarios']);
        Permission::create(['name'=>'Create users','display_name'=>'Crear usuarios']);
        Permission::create(['name'=>'Update users','display_name'=>'Actualizar usuarios']);
        Permission::create(['name'=>'Delete users','display_name'=>'Borrar usuarios']);

        Permission::create(['name'=>'View clients','display_name'=>'Ver clientes']);
        Permission::create(['name'=>'Create clients','display_name'=>'Crear clientes']);
        Permission::create(['name'=>'Update clients','display_name'=>'Actualizar clientes']);
        Permission::create(['name'=>'Delete clients','display_name'=>'Borrar clientes']);

        Permission::create(['name'=>'View tv service','display_name'=>'Ver servicios TV']);
        Permission::create(['name'=>'Create tv service','display_name'=>'Crear servicios TV']);
        Permission::create(['name'=>'Update tv service','display_name'=>'Actualizar servicios TV']);
        Permission::create(['name'=>'Delete tv service','display_name'=>'Borrar servicios TV']);

        Permission::create(['name'=>'View internet service','display_name'=>'Ver servicios internet']);
        Permission::create(['name'=>'Create internet service','display_name'=>'Crear servicios internet']);
        Permission::create(['name'=>'Update internet service','display_name'=>'Actualizar servicios internet']);
        Permission::create(['name'=>'Delete internet service','display_name'=>'Borrar servicios internet']);
        
        Permission::create(['name'=>'View days period','display_name'=>'Ver perodio dias']);
        Permission::create(['name'=>'Create days period','display_name'=>'Crear perodio dias']);
        Permission::create(['name'=>'Update days period','display_name'=>'Actualizar perodio dias']);
        Permission::create(['name'=>'Delete days period','display_name'=>'Borrar perodio dias']);
        
        Permission::create(['name'=>'View pos printer','display_name'=>'Ver impresoras termicas']);
        Permission::create(['name'=>'Create pos printer','display_name'=>'Crear impresoras termicas']);
        Permission::create(['name'=>'Update pos printer','display_name'=>'Actualizar impresoras termicas']);
        Permission::create(['name'=>'Delete pos printer','display_name'=>'Borrar impresoras termicas']);
        
        Permission::create(['name'=>'View products','display_name'=>'Ver productos']);
        Permission::create(['name'=>'Create products','display_name'=>'Crear productos']);
        Permission::create(['name'=>'Update products','display_name'=>'Actualizar productos']);
        Permission::create(['name'=>'Delete products','display_name'=>'Borrar productos']);

        Permission::create(['name'=>'View recargas','display_name'=>'Ver recargas']);
        Permission::create(['name'=>'Create recargas','display_name'=>'Crear recargas']);
        Permission::create(['name'=>'Update recargas','display_name'=>'Actualizar recargas']);
        Permission::create(['name'=>'Delete recargas','display_name'=>'Borrar recargas']);

        Permission::create(['name'=>'View roles','display_name'=>'Ver roles']);
        Permission::create(['name'=>'Create roles','display_name'=>'Crear roles']);
        Permission::create(['name'=>'Delete roles','display_name'=>'Borrar roles']);
        Permission::create(['name'=>'Update roles','display_name'=>'Actualizar roles']);

        Permission::create(['name'=>'View permissions','display_name'=>'Ver permisos']);
        Permission::create(['name'=>'Update permissions','display_name'=>'Actualizar permisos']);

        
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
