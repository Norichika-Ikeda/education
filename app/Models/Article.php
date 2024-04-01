<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory;

    protected function postedDate(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y年m月d日')
        );
    }
}
