<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DeliveryTimeRequest;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Illuminate\Support\Facades\DB;

class DeliveryTimeController extends Controller
{
    /**
     * ユーザー用
     */



    /**
     * 管理者用
     */
    public function deliveryTimeForm($id)
    {
        $curriculum_title = Curriculum::where('id', $id)->first(['id', 'title']);
        $delivery_times = DeliveryTime::where('curriculums_id', $id)->get();
        return view('admin.delivery_time_setting', ['curriculum_title' => $curriculum_title, 'delivery_times' => $delivery_times]);
    }

    public function deliveryTimeEdit(DeliveryTimeRequest $request)
    {
        DB::beginTransaction();
        try {
            $save_delivery_times = new DeliveryTime();
            $save_delivery_times->saveDeliveryTime($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect('admin/curriculum_management/1');
    }

    public function deliveryTimeDelete(Request $request)
    {
        $delete_id = $request->id;
        if ($delete_id !== null) {
            $delete_product = DeliveryTime::findOrFail($request->id);
            $delete_product->delete();
            return response()->json(
                compact('delete_id'),
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function deliveryTimeAdd(Request $request)
    {
        $delivery_time_last_id = DeliveryTime::latest('id')->first('id');
        return response()->json(
            compact('delivery_time_last_id'),
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
