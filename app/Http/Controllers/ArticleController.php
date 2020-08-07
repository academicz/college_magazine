<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleComment;
use App\Models\Like;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getNewArticlePage()
    {
        $categories = ArticleCategory::all();

        $data = [
            'categories' => $categories
        ];

        return view('Public.new_article', $data);
    }

    public function postArticle(Request $request)
    {
        $file = $request->file('coverImage');
        $extnsion = $file->guessClientExtension();
        $name = "article-" . rand(1000000, 9999999) . "." . $extnsion;
        $destinationPath = 'uploads/article-images';
        $file->move($destinationPath, $name);

        $article = new Article();
        $article->user_id = user()->id;
        $article->article_category_id = $request['category'];
        $article->title = $request['title'];
        $article->cover_image = $destinationPath . '/' . $name;
        $article->story = $request['story'];
        $article->status = 0;
        $article->save();
		
		return redirect()->route('home');
    }

    public function getArticle($id)
    {
        $article = Article::findOrFail($id);

        $data = [
            'article' => $article,
        ];

        return view('Public.article', $data);
    }

    public function likeArticle(Request $request)
    {
        if ($request['status']) {
            $like = new Like();
            $like->article_id = $request['article'];
            $like->user_id = user()->id;
            $like->save();
        } else {
            Like::where([['article_id', $request['article']], ['user_id', user()->id]])->delete();
        }


        return redirect()->route('getArticle', ['id' => $request['article']]);
    }

    public function postComment(Request $request)
    {
        $comment = new ArticleComment();
        $comment->article_id = $request['article_id'];
        $comment->user_id = user()->id;
        $comment->comment = $request['comment'];
        $comment->save();

        return redirect()->route('getArticle', ['id' => $request['article_id']]);
    }

    public function getCategory($id)
    {
        $data = [
            'articles' => Article::where('article_category_id', $id)->paginate(10),
            'category'=>ArticleCategory::find($id),
        ];

        return view('Public.category',$data);
    }
}
