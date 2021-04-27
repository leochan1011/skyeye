<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MissionreportController extends Controller
{
    
    public function report(){

        $data = DB::table('Mission')->select('CenterLat as Latitude','CenterLng as Longitude')->where('CenterLat','>',0)->get();
        return view('datavisualization',['latlng'=>$data]);
    }
    public function barchart(){
        $data = DB::table('Mission')->select(DB::raw('`MLocationName`,count(`MLocationName`) as `count`'))
                     ->whereNotNull('MLocationName')->Groupby('MLocationName')->orderByDesc('count')->get();
        $district = $data->pluck('MLocationName');
        $count = $data->pluck('count');
       
        return ['district'=>$district, 'count'=>$count];
    }
}