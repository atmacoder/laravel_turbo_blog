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

    public $settings, $name, $slogan, $avatar, $data, $color_header, $color_sitename, $color_footer, $links_color;
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
            $sourcePath = storage_path('tmp\uploads\\') . $this->images[0];
            $destinationPath = storage_path('app\public\\') . $this->images[0];
            File::move($sourcePath, $destinationPath);
            if (File::exists($destinationPath)) {
                $settings = Settings::first();
                $settings->logo = $this->images[0];
                $settings->update();
            }

        }

        $settings = Settings::first();
        $settings->name = $this->settings->name;
        $settings->data = serialize($this->designSettings);
        $settings->update();

        return redirect()->to('/settings')->with('status',__('main.settings_saved'));
    }
}
