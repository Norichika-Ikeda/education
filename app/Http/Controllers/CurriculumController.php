<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CurriculumRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Classes;
use App\Models\Curriculum;
use App\Models\DeliveryTime;

class CurriculumController extends Controller
{
    /**
     * ユーザー用
     */
    public function timetable()
    {
        $classes = Classes::get(['id', 'name']);
        $curriculums = Curriculum::get(['id', 'title', 'thumbnail']);
        $delivery_times = DeliveryTime::get(['id', 'curriculums_id', 'delivery_from', 'delivery_to']);
        return view('user.timetable', ['classes' => $classes, 'curriculums' => $curriculums, 'delivery_times' => $delivery_times]);
    }






    /**
     * 管理者用
     */

    public function showCurriculumManagement($id)
    {
        $now_class = Classes::find($id);
        $classes = Classes::where('id', '!=', $id)->get(['id', 'name']);
        $curriculums = Curriculum::where('classes_id', $id)->get(['id', 'title', 'thumbnail', 'alway_delivery_flg']);
        $delivery_times = DeliveryTime::get();
        return view('admin.curriculum_management', ['now_class' => $now_class, 'classes' => $classes, 'curriculums' => $curriculums, 'delivery_times' => $delivery_times]);
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
            $Curriculum = new Curriculum();
            $Curriculum->registCurriculum($request);
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
