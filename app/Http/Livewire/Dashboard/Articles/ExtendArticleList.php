<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use \App\Models\ExtendArticleTypes;
use Illuminate\Support\Facades\Auth;

class ExtendArticleList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.dashboard.articles.extend-article-list', [

            'extendArticleTypes' => ExtendArticleTypes::paginate(10),

        ]);
    }
    public function openModuleDeleteExtendArticle($article){
        $this->emit('activateModalExtendArticleDelete', $article);
    }
    public function editExtendArticle($id){
        $this->emit('editExtendArticle', $id);
        return redirect()->route('extend_article_edit', ['extend_article_id'=> $id]);
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('view_extend_article_types')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
}
