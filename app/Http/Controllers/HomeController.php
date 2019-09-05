<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Siswa\Siswa;
use App\Model\StudentClass\StudentClass;
use App\Model\AssessmentLog\AssessmentLog;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if($this->getUserPermission('index home'))
        {
            $siswa = Siswa::count();
            $class = StudentClass::count();
            $hafalan = AssessmentLog::where('date',date("Y-m-d"))->count();

            return view('home.index', ['active'=>'home', 'siswa'=>$siswa, 'class'=>$class, 'hafalan'=>$hafalan]);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'home']);
        }
    }
}
