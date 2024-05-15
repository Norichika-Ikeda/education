<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';

    protected $guarded = [];

    public function saveBanner($data)
    {
        $some_request = $data->banner_id;
        $upsertBanners = [];
        foreach ($some_request as $key => $val) {
            $banner_id = $data->banner_id[$key];
            $banner = $data->banner[$key];
            $already_banner = Banner::where('id', $banner_id)->first();
            $upsertBanners = [
                'id' => $banner_id ?? null,
                'image' => $banner ?? $already_banner->image
            ];
            Banner::upsert($upsertBanners, ['id']);
        }
    }
}
