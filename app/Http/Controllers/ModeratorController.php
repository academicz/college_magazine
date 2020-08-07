<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    /*
     * articls status 0: new or not approved 1:approved -1:rejected
     */

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllArticlesPage()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];
        return view('Moderator.new_articles', $data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArticles()
    {
        $articles = Article::where('status', 0)->with('article_category')->paginate(10);

        return response()->json(['articles' => $articles]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveArticle(Request $request)
    {
        $article = Article::find($request['id']);
        $article->status = 1;
        $article->save();

        return response()->json(['status' => true, 'message' => 'Article Approved']);
    }

    public function rejectArticle(Request $request)
    {
        $article = Article::find($request['id']);
        $article->status = -1;
        $article->why_reject = $request['reason'];
        $article->save();

        return response()->json(['status' => true, 'message' => 'Article Rejected']);
    }

    public function approvedArticles()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];
        return view('Moderator.approved_articles', $data);
    }

    public function getApprovedArticles()
    {
        $articles = Article::where('status', 1)->with('article_category')->paginate(10);

        return response()->json(['articles' => $articles]);
    }

    public function rejectedArticles()
    {
        $data = [
            'admin' => $this->checkAdminLogin(),
        ];
        return view('Moderator.rejected_articles', $data);
    }

    public function getRejectedArticles()
    {
        $articles = Article::where('status', -1)->with('article_category')->paginate(10);

        return response()->json(['articles' => $articles]);
    }
}
