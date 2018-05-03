<?php

namespace App\Http\Controllers\surveyor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surveyor.dashboard');
    }
}
