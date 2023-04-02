<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Livewire\Component;
use Illuminate\Http\Request;
use \App\Models\ExtendArticleTypes;

class ExtendArticleEdit extends Component
{
    public $name, $type, $extend_article, $type_name;

    public $types = [
        [ 'name' => 'text'],
        [ 'name' => 'number'],
        [ 'name' => 'textarea']

    ];
    public function render()
    {
        return view('livewire.dashboard.articles.extend-article-edit');
    }
    public function mount(Request $request){

        $this->extend_article = ExtendArticleTypes::find($request->extend_article_id);
        $this->name =  $this->extend_article->name;
        $this->type =  $this->extend_article->type;
    }

    public function updateExtendArticle()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $extend_article = ExtendArticleTypes::find($this->extend_article->id);
        $extend_article->name = $this->name;
        $extend_article->type = $this->type;
        $extend_article->update();

        return redirect()->to('extend-article-list')->with('status',__('main.extend_article') . ' '. $this->name . ' ' . __('main.extend_article_updated'));
    }
}
