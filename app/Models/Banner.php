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
            if (isset($data->banner[$key])) {
                $banner = $data->banner[$key];
                $file_name = $banner->getClientOriginalName();
                $banner->storeAs('public/images', $file_name);
            } else {
                $file_name = null;
            }
            $already_banner = Banner::where('id', $banner_id)->first('image');
            $upsertBanners = [
                'id' => $banner_id ?? null,
                'image' => $file_name ?? $already_banner->image
            ];
            Banner::upsert($upsertBanners, ['id']);
        }
    }
}
