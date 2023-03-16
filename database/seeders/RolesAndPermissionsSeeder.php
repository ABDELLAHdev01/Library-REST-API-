<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create permmisions for library's manger

        $editProfile = 'library.editProfile';
        $deleteProfile = 'library.deleteProfile';


        $addUser = 'library.addUser';
        $editUser = 'library.editUser';
        $deleteUser = 'library.deleteUser';
        $addRole = 'library.addRole';
        $editRole = 'library.editRole';
        $deleteRole = 'library.deleteRole';
        $addPermission = 'library.addPermission';
        $editPermission = 'library.editPermission';
        $deletePermission = 'library.deletePermission';


        $addBook = 'library.addBook';
        $editBook = 'library.editBook';
        $deleteBook = 'library.deleteBook';
        $addCategory = 'library.addCategory';
        $editCategory = 'library.editCategory';
        $deleteCategory = 'library.deleteCategory';

        // user permissions
        Permission::create(['name' => $editProfile]);
        Permission::create(['name' => $deleteProfile]);

     
        // admin permissions
        Permission::create(['name' => $addUser]);
        Permission::create(['name' => $editUser]);
        Permission::create(['name' => $deleteUser]);
        Permission::create(['name' => $addRole]);
        Permission::create(['name' => $editRole]);
        Permission::create(['name' => $deleteRole]);
        Permission::create(['name' => $addPermission]);
        Permission::create(['name' => $editPermission]);
        Permission::create(['name' => $deletePermission]);

        // librarian permissions
        Permission::create(['name' => $addBook]);
        Permission::create(['name' => $editBook]);
        Permission::create(['name' => $deleteBook]);
        Permission::create(['name' => $addCategory]);
        Permission::create(['name' => $editCategory]);
        Permission::create(['name' => $deleteCategory]);

        $admin = 'admin';
        $librarian = 'librarian';
        $user = 'user';

        // create roles and assign created permissions
        $role = Role::create(['name' => $admin]);
        $role->givePermissionTo(Permission::all());
        

        $role2 = Role::create(['name' => $librarian]);
        $role2->givePermissionTo($addBook);
        $role->givePermissionTo($editBook);
        $role2->givePermissionTo($deleteBook);
        $role2->givePermissionTo($addCategory);
        $role2->givePermissionTo($editCategory);
        $role2->givePermissionTo($deleteCategory);

        $role3 = Role::create(['name' => $user]);
        $role3->givePermissionTo($editProfile);
        $role3->givePermissionTo($deleteProfile);
        
        
        

    }
}
