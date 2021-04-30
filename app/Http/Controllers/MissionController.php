<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Classes\LonLatCalculator;
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
        $mid = $id;
        $sql = DB::table('Mission')->select('CenterLat', 'CenterLng', 'MRange')
                ->where('MID','=',$id)->get();
        $lat = $sql->pluck('CenterLat')[0];
        $lng = $sql->pluck('CenterLng')[0];
        $radius = $sql->pluck('MRange')[0];

    function waypoint($lon, $lat, $dist){
        $test = new LonLatCalculator;
        $loc_array = [];
        $brng = 0;
        array_push($loc_array,Array("Latitude" => $lat, "Longitude" => $lon));
        $newlon = 0;
        $newlat = 0;
    
        $test->computerThatLonLat($lon, $lat, $brng, $dist);
        $newlon = $test->getLongitude();
        $newlat = $test->getLatitude();
        array_push($loc_array,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
        $brng = 120;
        $test->computerThatLonLat($newlon, $newlat, $brng, $dist);
        $newlon = $test->getLongitude();
        $newlat = $test->getLatitude();
        array_push($loc_array,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
        $brng = 240;
        $test->computerThatLonLat($newlon, $newlat, $brng,2 * $dist);
        $newlon = $test->getLongitude();
        $newlat = $test->getLatitude();
        array_push($loc_array,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
        $brng = 0;
        $test->computerThatLonLat($newlon, $newlat, $brng,$dist);
        $newlon = $test->getLongitude();
        $newlat = $test->getLatitude();
        array_push($loc_array,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
        $brng = 120;
        $test->computerThatLonLat($newlon, $newlat, $brng,2 * $dist);
        $newlon = $test->getLongitude();
        $newlat = $test->getLatitude();
        array_push($loc_array,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
        $brng = 240;
        $test->computerThatLonLat($newlon, $newlat, $brng,$dist);
        $newlon = $test->getLongitude();
        $newlat = $test->getLatitude();
        array_push($loc_array,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
        $brng = 0;
        $test->computerThatLonLat($newlon, $newlat, $brng,$dist);
        $newlon = $test->getLongitude();
        $newlat = $test->getLatitude();
        array_push($loc_array,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
        return $loc_array;
    }
    $result = waypoint($lng, $lat, $radius);
            if(sizeof($result) > 0){
                $json = array("status"=>0, "result"=>$result);
            }else{
                $json = array("status"=>1);
            }
        // $json = file_get_contents($url = 'http://127.0.0.1:8000/wayp/'.$mid);
        // $json = json_decode($json,true);
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
