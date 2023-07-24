<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\User;
use \App\Models\Settings;

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

        Permission::create(['name' => 'edit_settings']);

        $role = Role::find(1);
        $permissions = Permission::pluck('name')->all();

        $role->syncPermissions($permissions);

        $settings = Settings::first();
        $settings->name = 'Laravel Turbo Blog';
        $designSettings = [
            'background_header' => 'linear-gradient(0.0deg,hsla(0,0%,100%,1) 0.0,hsla(180,84%,78%,1) 56.2%,hsla(198,100%,50%,0.43) 100.0%)',
            'background_footer' => 'linear-gradient(0.0deg,hsla(201,97%,42%,1) 0.0,hsla(0,0%,0%,0) 100.0%)',
            'background_card_header' => 'linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)',
            'color_sitename' => '#000000',
            'links_color' => '#214DF7',
            'h1_color' => '#FF2C0E',
            'menu_link_color' => '#F712F1',
            'menu_hover_link_color' => '#10d2f5',
        ];
        $settings->data = serialize($designSettings);
        $settings->update();
    }
}
