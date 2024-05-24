<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapGenerator;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function generate_sitemap_index()
    {
        // Создаем карту сайта
        $sitemap = Sitemap::create(app('url')->to('/'));

        // Добавляем URL-адреса категорий в карту сайта
        foreach (Category::all() as $category) {
            $sitemap->add(Url::create($category->slug));
        }

        // Добавляем URL-адреса статей в карту сайта
        foreach (Article::all() as $article) {
            $sitemap->add(Url::create($article->category->slug . '/' . $article->slug));
        }

        // Генерируем XML-карту сайта
        $xml = $sitemap->toXml();

        // Кэшируем карту сайта
        Cache::forever('sitemap.xml', $xml);

        // Отправляем XML-файл как ответ
        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    public function generate_sitemap()
    {
        // Создаем карту сайта
        $sitemap = Sitemap::create(app('url')->to('/'));

        // Добавляем URL-адреса категорий в карту сайта
        foreach (Category::all() as $category) {
            $sitemap->add(Url::create($category->slug));
        }

        // Добавляем URL-адреса статей в карту сайта
        foreach (Article::all() as $article) {
            $sitemap->add(Url::create($article->category->slug . '/' . $article->slug));
        }

        // Создаем и кэшируем карту сайта
        $sitemap->writeToFile(public_path('sitemap.xml'));
        Cache::forever('sitemap.xml', file_get_contents(public_path('sitemap.xml')));

        return redirect()->back()->with('success', 'Карта сайта успешно обновлена.');
    }
}
