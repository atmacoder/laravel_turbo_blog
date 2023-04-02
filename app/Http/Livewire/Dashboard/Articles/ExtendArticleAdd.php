<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Livewire\Component;
use \App\Models\ExtendArticleTypes;

class ExtendArticleAdd extends Component
{
    public $name,$type,$value;

    public $types = [
        [ 'name' => 'text'],
        [ 'name' => 'number'],
        [ 'name' => 'textarea']

    ];

    public function render()
    {
        return view('livewire.dashboard.articles.extend-article-add');
    }
    public function createExtendArticle()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $newExtendType = new ExtendArticleTypes;
        $newExtendType->name = $this->name;
        $newExtendType->type = $this->type;
        $newExtendType->save();

        return redirect()->to('extend-article-list')->with('status',__('main.article') . ' '. $this->name . ' ' . __('main.extend_article_created'));
    }
}
