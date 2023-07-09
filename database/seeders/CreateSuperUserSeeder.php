<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\User;

class CreateSuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'xkw@mail.ru',
            'password' => bcrypt('qweqwe')
        ]);

        Role::create([
            'name' => 'SuperUser',
        ]);

        $admin->assignRole('SuperUser');

        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'view_users']);
        Permission::create(['name' => 'delete_users']);
        Permission::create(['name' => 'edit_users']);

        Permission::create(['name' => 'create_roles']);
        Permission::create(['name' => 'view_roles']);
        Permission::create(['name' => 'delete_roles']);
        Permission::create(['name' => 'edit_roles']);

        Permission::create(['name' => 'create_permissions']);
        Permission::create(['name' => 'view_permissions']);
        Permission::create(['name' => 'delete_permissions']);
        Permission::create(['name' => 'edit_permissions']);

        Permission::create(['name' => 'create_categories']);
        Permission::create(['name' => 'view_categories']);
        Permission::create(['name' => 'delete_categories']);
        Permission::create(['name' => 'edit_categories']);

        Permission::create(['name' => 'create_articles']);
        Permission::create(['name' => 'view_articles']);
        Permission::create(['name' => 'delete_articles']);
        Permission::create(['name' => 'edit_articles']);

        Permission::create(['name' => 'create_extend_article']);
        Permission::create(['name' => 'view_extend_article']);
        Permission::create(['name' => 'delete_extend_article']);
        Permission::create(['name' => 'edit_extend_article']);

        Permission::create(['name' => 'create_extend_article_types']);
        Permission::create(['name' => 'view_extend_article_types']);
        Permission::create(['name' => 'delete_extend_article_types']);
        Permission::create(['name' => 'edit_extend_article_types']);

        Permission::create(['name' => 'create_comments']);
        Permission::create(['name' => 'view_comments']);
        Permission::create(['name' => 'delete_comments']);
        Permission::create(['name' => 'edit_comments']);

        $role = Role::find(1);
        $permissions = Permission::pluck('name')->all();

        $role->syncPermissions($permissions);

    }
}
