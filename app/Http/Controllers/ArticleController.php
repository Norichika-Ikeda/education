<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function top()
    {
        $articles = Article::select('id', 'title', 'posted_date', 'article_contents')->get();
        return view('top', ['articles' => $articles]);
    }

    public function article()
    {
        return view('articles');
    }
}
