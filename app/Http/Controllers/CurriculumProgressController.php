<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurriculumProgressController extends Controller
{
    public function progress()
    {
        return view('progress');
    }
}
