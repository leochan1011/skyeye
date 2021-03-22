<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    // Show all the mission data
    public function index(){
        //$mission = DB::select('select * from Mission ', [1]);
        $mission = DB::table('Mission')->leftJoin('UserAccount', 'Mission.MCreator', '=', 'UserAccount.id')->select('Mission.*', 'UserAccount.uname')->get();
        return view('mission', ['mission_info' => $mission]);  
        //return dd($mission);
    }

    // Show each row of the data
    public function show($id){
        $mission_Detail = DB::select("select * from Mission WHERE MID = '$id'" );
        return view('mDetail', ['mDetail' => $mission_Detail[0]]);
        //return dd($mission_Detail[0]);
    }
}
