<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    /**
     * ユーザー用
     */
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



    /**
     * 管理者用
     */
    public function showArticleManagement()
    {
        $articles = Article::orderByDesc('posted_date')->get();
        return view('admin.article_management', ['articles' => $articles]);
    }

    public function articleCreateForm()
    {
        return view('admin.article_setting');
    }

    public function articleCreate(ArticleRequest $request)
    {
        DB::beginTransaction();
        try {
            $article = new Article();
            $article->registArticle($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect('admin/article_management');
    }

    public function articleEditForm($id)
    {
        $article = Article::query()->where('id', '=', $id)->first();
        return view('admin.article_setting', ['article' => $article]);
    }

    public function articleEdit(ArticleRequest $request)
    {
        DB::beginTransaction();
        try {
            $article = Article::find($request->id);
            $article->updateArticle($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect('admin/article_management');
    }

    public function articleDelete(Request $request)
    {
        $delete_id = $request->id;
        if ($delete_id !== null) {
            $delete_article = Article::findOrFail($request->id);
            $delete_article->delete();
            return response()->json(
                compact('delete_id'),
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
    }
}
