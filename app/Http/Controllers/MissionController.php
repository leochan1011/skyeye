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
        $token='c9d33c1b95202bf37815c9c80c6be010';
        $mid = $id;
        $json = file_get_contents($url = 'http://localhost/ogweb/application/waypoint/get.php?token='.$token.'&mid='.$mid);
        $json = json_decode($json,true);
        $json = $json['result'];
        return view('mDetail', ['mDetail' => $mission_Detail[0]],
                                ['wayp' => $json]);
        //return dd($mission_Detail[0]);
    }

    public function getMissionCount() {
        // monthly
        $data = DB::table('Mission')
        ->select(DB::raw('count(*) as `count`'),  DB::raw('min(date(MCreateTime)) as date'))//,DB::raw('YEAR(MCreateTime) year'),DB::raw('MONTH(MCreateTime) month'),DB::raw('DAY(MCreateTime) day'))
        ->groupBy(DB::raw('YEAR(MCreateTime)'), DB::raw('MONTH(MCreateTime)'))
        ->orderBy('date')
        // ->whereMonth('MCreateTime', '<>', 3)
        ->get();

        $count = $data->pluck('count');
        $label = $data->pluck('date');

        $data1 =  DB::table('Mission')
        ->select(DB::raw('count(*) as `count`'),  DB::raw('min(date(MCreateTime)) as date'))
        ->groupBy(DB::raw('YEAR(MCreateTime)'), DB::raw('MONTH(MCreateTime)'))
        ->where('MCreator','=',1)
        ->orderBy('date')
        ->get();

        $count1 = $data1->pluck('count');

        $data2 = DB::table('Mission')
        ->select(DB::raw('count(*) as `count`'),  DB::raw('min(date(MCreateTime)) as date'))
        ->groupBy(DB::raw('YEAR(MCreateTime)'), DB::raw('MONTH(MCreateTime)'))
        ->where('MCreator','=',2)
        ->orderBy('date')
        ->get();

        $count2 = $data2->pluck('count');
        //Day
        // $data2 = $data
        // ->select(DB::raw('count(*) as `count`'),  DB::raw('min(date(MCreateTime)) as date'))//,DB::raw('YEAR(MCreateTime) year'),DB::raw('MONTH(MCreateTime) month'),DB::raw('DAY(MCreateTime) day'))
        // ->groupBy(DB::raw('YEAR(MCreateTime)'), DB::raw('MONTH(MCreateTime)'), DB::raw('DAY(MCreateTime)'))
        // ->orderBy('date')
        // ->get();



        // $count_day = $data2->pluck('count');
        // $label_day = $data2->pluck('date');


        return [
            'count' => $count,
            'label' => $label,
            'count1' => $count1,
            'count2' => $count2,
        ];
    }

    public function test(){
        $data =  DB::table('Mission')->select(DB::raw('count(*) as `count`'),  DB::raw('min(date(MCreateTime)) as date'))
        ->groupBy(DB::raw('YEAR(MCreateTime)'), DB::raw('MONTH(MCreateTime)'), DB::raw('DAY(MCreateTime)'))
        ->where('MCreator','=',2)
        ->orderBy('date')
        ->get();
        return $data;
    }

}
