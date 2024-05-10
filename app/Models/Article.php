<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';

    protected $guarded = [];

    protected function postedDate(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y-m-d')
        );
    }

    public function registArticle($data)
    {
        DB::table('articles')->insert([
            'title' => $data->title,
            'posted_date' => $data->posted_date,
            'article_contents' => $data->content,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    public function updateArticle($data)
    {
        $article_id = Article::find($data->id);
        $article_id->update([
            'title' => $data->title,
            'posted_date' => $data->posted_date,
            'article_contents' => $data->content,
        ]);
    }
}
