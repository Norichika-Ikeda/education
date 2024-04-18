<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classes;
use App\Models\Curriculum;
use App\Models\DeliveryTime;

class CurriculumController extends Controller
{
    public function timetable()
    {
        $classes = Classes::get(['id', 'name']);
        $curriculums = Curriculum::get(['id', 'title', 'thumbnail']);
        $delivery_times = DeliveryTime::get(['id', 'curriculums_id', 'delivery_from', 'delivery_to']);
        return view('timetable', ['classes' => $classes, 'curriculums' => $curriculums, 'delivery_times' => $delivery_times]);
    }
}
