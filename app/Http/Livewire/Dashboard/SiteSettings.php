<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use \App\Models\Settings;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;
use IlluminateSupportFacadesStorage;
use IlluminateSupportStr;

class SiteSettings extends Component
{
    use WithFileUploads;

    public $settings, $name, $slogan, $avatar, $data, $links_color, $imageBackgroundHeader, $imageBackgroundFooter, $imageBackgroundBg;
    public $images = [];

    public $designSettings = [
        'background_header' => '#FFFFFF',
        'background_footer' => 'linear-gradient(0.0deg,hsla(279,63%,58%,1) 0.0,hsla(198,83%,53%,1) 100.0%)',
        'background_card_header' => '#FFFFFF',
        'color_sitename' => '#FFFFFF',
        'links_color' => '#3aaaf7',
        'h1_color' => '#000000',
        'menu_link_color' => '#3aaaf7',
        'menu_hover_link_color' => '#10d2f5',
        'logo_text_color' => '#FFF',
        'footer_text_color' => '#FFF',
        'logo_text_size' => '16',
        'category_text_size' => '21',
        'category_text_color' => '#FFF',
        'article_body_color' => '#FFF',
        'breadcrumb_a' => '#FFF',
        'article_title' => '#FFF',
        'comment_form_text' => '#FFF',
        'scroll_top_background' => '#000',
        'imageBackgroundHeader' => '/storage/background/header_bg.jpg',
        'imageBackgroundFooter' => '/storage/background/footer_bg.jpg',
        'imageBackgroundBg' => '/storage/background/bg.jpg',
        'show_img_logo' => false,
        'show_logo_text' => true,
        'show_category_desc' => true,
        'info_blog_header_right' => '<p>This is Free Laravel Turbo Blog</p>',
        'info_blog_footer' => '<small>Laravel Turbo Blog все права защищены. 2024 © <a href="/dashboard">Admin</a></small>',
        'class_main_buttons' => 'btn-success',
        'menu_text_color' => '#FFF',
        'menu_active_text_color' => '#000',
        'menu_text_color_hover' => '#FFF',
        'background_menu' => 'linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)',
        'background_card_header_frontend' => 'linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)',
        'background_card_header_body_frontend' => 'linear-gradient(0.0deg,hsla(206,90%,20%,0.15) 0.0,hsla(187,100%,38%,0.19) 100.0%)',
        'background_card_header_frontend_color' => '#FFF',
        'background_card_header_frontend_color_bb' => '#FFF',
    ];

    public function render()
    {
        return view('livewire.dashboard.site-settings');
    }

    public function mount()
    {


        $settings = Settings::first();
        $this->settings = $settings;

        $this->name = $settings->name;
        $this->slogan = $settings->slogan;
        $this->designSettings = $settings->data;

        if (!isset($this->designSettings['show_img_logo'])) {

            $this->designSettings['show_img_logo'] = true;
        }
        if (!isset($this->designSettings['show_logo_text'])) {

            $this->designSettings['show_logo_text'] = false;
        }
        if (!isset($this->designSettings['logo_text_color'])) {

            $this->designSettings['logo_text_color'] = "#FFF";
        }
        if (!isset($this->designSettings['logo_text_size'])) {

            $this->designSettings['logo_text_size'] = "16";
        }
        if (!isset($this->designSettings['category_text_size'])) {

            $this->designSettings['category_text_size'] = "21";
        }
        if (!isset($this->designSettings['info_blog_header_right'])) {

            $this->designSettings['info_blog_header_right'] = '<p>This is Free Laravel Turbo Blog</p>';
        }
        if (!isset($this->designSettings['menu_text_color'])) {
            $this->designSettings['menu_text_color'] = '#FFF';
        }
        if (!isset($this->designSettings['menu_text_color_hover'])) {
            $this->designSettings['menu_text_color_hover'] = '#FFF';
        }
        if (!isset($this->designSettings['background_card_header_frontend_color_bb'])) {
            $this->designSettings['background_card_header_frontend_color_bb'] = '#FFF';
        }
        if (!isset($this->designSettings['menu_active_text_color'])) {

            $this->designSettings['menu_active_text_color'] = '#000';
        }
        if (!isset($this->designSettings['background_menu'])) {

            $this->designSettings['background_menu'] = "linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)";
        }
        if (!isset($this->designSettings['background_card_header_frontend'])) {

            $this->designSettings['background_card_header_frontend'] = "linear-gradient(0.0deg,hsla(187,72%,71%,0.02) 0.0,hsla(187,100%,38%,1) 100.0%)";
        }
        if (!isset($this->designSettings['background_card_header_body_frontend'])) {

            $this->designSettings['background_card_header_body_frontend'] = "linear-gradient(0.0deg,hsla(206,90%,20%,0.15) 0.0,hsla(187,100%,38%,0.19) 100.0%)";
        }
        if (!isset($this->designSettings['background_card_header_frontend_color'])) {

            $this->designSettings['background_card_header_frontend_color'] = "#FFF";
        }
        if (!isset($this->designSettings['footer_text_color'])) {

            $this->designSettings['footer_text_color'] = "#FFF";
        }
        if (!isset($this->designSettings['category_text_color'])) {

            $this->designSettings['category_text_color'] = "#FFF";
        }
        if (!isset($this->designSettings['article_title'])) {

            $this->designSettings['article_title'] = "#FFF";
        }
        if (!isset($this->designSettings['article_body'])) {

            $this->designSettings['article_body'] = "#FFF";
        }
        if (!isset($this->designSettings['comment_form_text'])) {

            $this->designSettings['comment_form_text'] = "#FFF";
        }
        if (!isset($this->designSettings['breadcrumb_a'])) {

            $this->designSettings['breadcrumb_a'] = "#FFF";
        }
        if (!isset($this->designSettings['scroll_top_background'])) {

            $this->designSettings['scroll_top_background'] = "#000";
        }
        if (!isset($this->designSettings['show_category_desc'])) {

            $this->designSettings['show_category_desc'] = true;
        }
        if (!isset($this->designSettings['info_blog_footer'])) {

            $this->designSettings['info_blog_footer'] = '<small>Laravel Turbo Blog все права защищены. 2024 © <a href="/dashboard">Admin</a></small>';
        }
    }

    public function setImages($name)
    {
        array_push($this->images, $name);
    }
    public function setDesign($name,$value){
    $this->designSettings[$name] = $value['color']['str'];
    }
    public function saveSettings()
    {
        if ($this->images && $this->images[0]) {
            $sourcePath = storage_path('tmp/uploads/') . $this->images[0];
            $destinationPath = storage_path('app/public/') . $this->images[0];
            File::move($sourcePath, $destinationPath);
            if (File::exists($destinationPath)) {
                $settings = Settings::first();
                $settings->logo = $this->images[0];
                $settings->update();
            }

        }
        if($this->imageBackgroundHeader){
            $this->imageBackgroundHeader->storeAs('background', 'header_bg.' . $this->imageBackgroundHeader->getClientOriginalExtension(), 'public');
            $this->designSettings['imageBackgroundHeader'] = '/storage/background/'.'header_bg.' . $this->imageBackgroundHeader->getClientOriginalExtension();
        }
        if($this->imageBackgroundFooter){
            $this->imageBackgroundFooter->storeAs('background', 'footer_bg.' . $this->imageBackgroundFooter->getClientOriginalExtension(), 'public');
            $this->designSettings['imageBackgroundFooter'] = '/storage/background/'.'footer_bg.' . $this->imageBackgroundFooter->getClientOriginalExtension();
        }
        if($this->imageBackgroundBg){
            $this->imageBackgroundBg->storeAs('background', 'bg.' . $this->imageBackgroundBg->getClientOriginalExtension(), 'public');
            $this->designSettings['imageBackgroundBg'] = '/storage/background/'.'bg.' . $this->imageBackgroundBg->getClientOriginalExtension();
        }

        $settings = Settings::first();
        $settings->name = $this->name;
        $settings->data = serialize($this->designSettings);
        $settings->update();



        return redirect()->to('/settings')->with('status',__('main.settings_saved'));
    }
}
