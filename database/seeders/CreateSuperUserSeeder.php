<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\User;
use \App\Models\ExtendArticleTypes;
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
		
		$newExtendType = new ExtendArticleTypes;
        $newExtendType->name = 'Краткое описание';
        $newExtendType->type = 'textarea';
        $newExtendType->save();
    
		$settings = Settings::first();

		if(!$settings){
			$settings = new Settings;
		$settings->name = 'Laravel Turbo Blog';
        $designSettings = [
  "background_header" => "linear-gradient(0.0deg,hsla(0,0%,100%,1) 0.0,hsla(180,84%,78%,1) 56.2%,hsla(198,100%,50%,0.43) 100.0%)",
  "background_footer" => "linear-gradient(0.0deg,hsla(201,97%,42%,1) 0.0,hsla(0,0%,0%,0) 100.0%)",
  "background_card_header" => "linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)",
  "color_sitename" => "#000000",
  "links_color" => "#214DF7",
  "h1_color" => "#FF2C0E",
  "menu_link_color" => "#F712F1",
  "menu_hover_link_color" => "#10d2f5",
  "show_img_logo" => true,
  "show_logo_text" => true,
  "imageBackgroundHeader" => "/storage/background/header_bg.png",
  "imageBackgroundFooter" => "/storage/background/footer_bg.png",
  "imageBackgroundBg" => "/storage/background/bg.png",
  "logo_text_color" => "#EDFFD0",
  "logo_text_size" => "16",
  "info_blog_header_right" => "<p>This is Free Laravel Turbo Blog ask me for more info </p>",
  "class_main_buttons" => "btn-outline-info",
  "menu_text_color" => "#010D10",
  "menu_active_text_color" => "#000",
  "background_menu" => "linear-gradient(0.0deg,hsla(279,63%,58%,0.68) 0.0,hsla(198,83%,53%,0.63) 100.0%)",
  "menu_text_color_hover" => "#CC0CC3",
  "background_card_header_frontend" => "linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)",
  "background_card_header_frontend_color" => "#EFE5FF",
  "background_card_header_body_frontend" => "linear-gradient(0.0deg,hsla(279,63%,58%,0.67) 100.0%,hsla(187,100%,38%,0.1) 0.0)",
  "background_card_header_frontend_color_bb" => "#0122E2",
  "category_text_size" => "21",
  "show_category_desc" => "1",
  "info_blog_footer" => "<small>Laravel Turbo Blog все права защищены. 2024 © <a href=\"/dashboard\">Admin</a></small>",
  "footer_text_color" => "#05A8FF",
  "category_text_color" => "#1B097F",
  "article_title" => "#FFF",
  "article_body" => "#FFF",
  "breadcrumb_a" => "#CDFFA3",
  "comment_form_text" => "#FFF",
  "scroll_top_background" => "#000"
        ];
        $settings->data = serialize($designSettings);
        $settings->save();
		}
		else{
        $settings->name = 'Laravel Turbo Blog';
        $designSettings = [
  "background_header" => "linear-gradient(0.0deg,hsla(0,0%,100%,1) 0.0,hsla(180,84%,78%,1) 56.2%,hsla(198,100%,50%,0.43) 100.0%)",
  "background_footer" => "linear-gradient(0.0deg,hsla(201,97%,42%,1) 0.0,hsla(0,0%,0%,0) 100.0%)",
  "background_card_header" => "linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)",
  "color_sitename" => "#000000",
  "links_color" => "#214DF7",
  "h1_color" => "#FF2C0E",
  "menu_link_color" => "#F712F1",
  "menu_hover_link_color" => "#10d2f5",
  "show_img_logo" => true,
  "show_logo_text" => true,
  "imageBackgroundHeader" => "/storage/background/header_bg.png",
  "imageBackgroundFooter" => "/storage/background/footer_bg.png",
  "imageBackgroundBg" => "/storage/background/bg.png",
  "logo_text_color" => "#EDFFD0",
  "logo_text_size" => "16",
  "info_blog_header_right" => "<p>This is Free Laravel Turbo Blog ask me for more info </p>",
  "class_main_buttons" => "btn-outline-info",
  "menu_text_color" => "#010D10",
  "menu_active_text_color" => "#000",
  "background_menu" => "linear-gradient(0.0deg,hsla(279,63%,58%,0.68) 0.0,hsla(198,83%,53%,0.63) 100.0%)",
  "menu_text_color_hover" => "#CC0CC3",
  "background_card_header_frontend" => "linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)",
  "background_card_header_frontend_color" => "#EFE5FF",
  "background_card_header_body_frontend" => "linear-gradient(0.0deg,hsla(279,63%,58%,0.67) 100.0%,hsla(187,100%,38%,0.1) 0.0)",
  "background_card_header_frontend_color_bb" => "#0122E2",
  "category_text_size" => "21",
  "show_category_desc" => "1",
  "info_blog_footer" => "<small>Laravel Turbo Blog все права защищены. 2024 © <a href=\"/dashboard\">Admin</a></small>",
  "footer_text_color" => "#05A8FF",
  "category_text_color" => "#1B097F",
  "article_title" => "#FFF",
  "article_body" => "#FFF",
  "breadcrumb_a" => "#CDFFA3",
  "comment_form_text" => "#FFF",
  "scroll_top_background" => "#000"
        ];
        $settings->data = serialize($designSettings);
        $settings->update();
		}
    }
}
