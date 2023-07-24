<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Livewire\Component;
use \App\Models\ExtendArticleTypes;
use Illuminate\Support\Facades\Auth;

class ExtendArticleAdd extends Component
{
    public $name,$type,$value;

    public $types = [
        [ 'name' => 'text'],
        [ 'name' => 'number'],
        [ 'name' => 'textarea'],
        [ 'name' => 'boolean']

    ];

    public function render()
    {
        return view('livewire.dashboard.articles.extend-article-add');
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('view_extend_article_types') || !$user->can('create_extend_article_types')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    public function createExtendArticle()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $user = Auth::user();

        if ($user->can('create_extend_article_types')) {

        $newExtendType = new ExtendArticleTypes;
        $newExtendType->name = $this->name;
        $newExtendType->type = $this->type;
        $newExtendType->save();

            }
        else{
            return redirect()->to('/no-permission');
        }
        return redirect()->to('extend-article-list')->with('status',__('main.article') . ' '. $this->name . ' ' . __('main.extend_article_created'));
    }
}
