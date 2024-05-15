<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{

    /**
     * 管理者用
     */
    public function showBannerManagement()
    {
        $banners = Banner::select('id', 'image')->get();
        return view('admin.banner_management', ['banners' => $banners]);
    }

    public function bannerEdit(BannerRequest $request)
    {
        DB::beginTransaction();
        try {
            $save_banners = Banner::first();
            $save_banners->saveBanner($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect('admin/banner_management');
    }

    public function bannerDelete(Request $request)
    {
        $delete_id = $request->id;
        if ($delete_id !== null) {
            $delete_banner = Banner::findOrFail($request->id);
            $delete_banner->delete();
            return response()->json(
                compact('delete_id'),
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function bannerAdd(Request $request)
    {
        $banner_last_id = Banner::latest('id')->first('id');
        return response()->json(
            compact('banner_last_id'),
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
