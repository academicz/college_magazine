<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHome()
    {
        $articles = Article::where('status', 1)->orderBy('created_at', 'desc')->paginate(5);
        $bannerArticles = Article::inRandomOrder()->take(5)->where('status', 1)->get();
        $categories = ArticleCategory::all();
        $popularArticles = Article::where('status', 1)->withCount('like')->orderBy('like_count','desc')->take(5)->get();

        $data = [
            'articles' => $articles,
            'bannerArticles' => $bannerArticles,
            'categories' => $categories,
            'popularArticles' => $popularArticles
        ];

        return view('Public.home', $data);
    }
}
