<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurriculumProgressController extends Controller
{
    public function progress()
    {
        $user = Auth::user();
        return view('user.progress', ['user' => $user]);
    }
}
