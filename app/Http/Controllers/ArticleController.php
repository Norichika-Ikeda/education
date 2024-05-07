<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    public function top()
    {
        $banners = Banner::get('image');
        $articles = Article::select('id', 'title', 'posted_date', 'article_contents')->get();
        return view('user.top', ['banners' => $banners, 'articles' => $articles]);
    }

    public function article($id)
    {
        $article = Article::find($id);
        return view('articles', ['article' => $article]);
    }

    public function adminTop()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.top');
        }
    }
}
