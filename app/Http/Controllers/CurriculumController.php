<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CurriculumRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Carbon\Carbon;

class CurriculumController extends Controller
{
    /**
     * ユーザー用
     */
    public function timetable()
    {
        $user = Auth::user();
        $today = Carbon::now();
        $next_month = Carbon::now()->addMonthsNoOverflow()->format('Y-n');
        $prev_month = Carbon::now()->subMonthsNoOverflow()->format('Y-n');
        // dump($prev_month);
        // dump($next_month);
        $now_class = Classes::where('id', $user->classes_id)->first(['id', 'name']);
        $classes = Classes::get(['id', 'name']);
        $curriculums = Curriculum::where('classes_id', $user->classes_id)->get(['id', 'title', 'thumbnail', 'alway_delivery_flg']);
        $delivery_times = DeliveryTime::whereMonth('delivery_from', $today)->get(['id', 'curriculums_id', 'delivery_from', 'delivery_to']);
        return view('user.timetable', compact(
            'user',
            'today',
            'next_month',
            'prev_month',
            'now_class',
            'classes',
            'curriculums',
            'delivery_times'
        ));
    }

    public function prevMonthTimetable(Request $request)
    {
        $user = Auth::user();
        $prev_year_month = $request->year . '-' . $request->month;
        $curriculums = Curriculum::where(
            'classes_id',
            $user->classes_id
        )->whereHas('deliveryTimes', function ($q) use ($prev_year_month) {
            $q->where('delivery_from', 'like', '%' . $prev_year_month . '%');
        })->get(['id', 'title', 'thumbnail', 'alway_delivery_flg']);
        return response()->json(
            compact('curriculums'),
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }






    /**
     * 管理者用
     */

    public function showCurriculumManagement(Request $request, $id)
    {
        $now_class = Classes::find($id);
        $classes = Classes::where('id', '!=', $id)->get(['id', 'name']);
        $curriculums = Curriculum::where('classes_id', $id)->get(['id', 'title', 'thumbnail', 'alway_delivery_flg']);
        $delivery_times = DeliveryTime::get();
        if ($request->ajax()) {
            return response()->json(
                compact('now_class', 'classes', 'curriculums', 'delivery_times'),
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        } else {
            return view('admin.curriculum_management', ['now_class' => $now_class, 'classes' => $classes, 'curriculums' => $curriculums, 'delivery_times' => $delivery_times]);
        }
    }


    public function curriculumCreateForm()
    {
        $classes = Classes::get(['id', 'name']);
        return view('admin.curriculum_setting', ['classes' => $classes]);
    }

    public function curriculumCreate(CurriculumRequest $request)
    {
        DB::beginTransaction();
        try {
            $curriculum = new Curriculum();
            $curriculum->registCurriculum($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect('admin/curriculum_management/1');
    }

    public function curriculumEditForm($id)
    {
        $classes = Classes::get(['id', 'name']);
        $curriculum = Curriculum::find($id);
        return view('admin.curriculum_setting', ['classes' => $classes, 'curriculum' => $curriculum]);
    }

    public function curriculumEdit(CurriculumRequest $request)
    {
        DB::beginTransaction();
        try {
            $curriculum = Curriculum::find($request->id);
            $curriculum->updateCurriculum($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        return redirect('admin/curriculum_management/1');
    }
}
