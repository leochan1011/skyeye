<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Classes\LonLatCalculator;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    // Show all the mission data
    // public function index(){
        
    //     $mission = DB::table('Mission')->leftJoin('UserAccount', 'Mission.MCreator', '=', 'UserAccount.id')->select('Mission.*', 'UserAccount.uname')->get();
    //     return view('mission', ['mission_info' => $mission]);  
        
    // }

    public function index(Request $request){
        $term = $request->term;
        $mission = DB::table('Mission')->leftJoin('UserAccount', 'Mission.MCreator', '=', 'UserAccount.id')
        ->select('Mission.*', 'UserAccount.uname')->Where('Mission.MID', 'LIKE', $term)
        ->orWhere('Mission.MNAME','Like','%'.$term.'%')
        ->orWhere('Mission.MLocationName','Like','%'.$term.'%')
        ->orderBy('MID','desc')->get();
        

        // $mission = DB::table('Mission')->leftJoin('UserAccount', 'Mission.MCreator', '=', 'UserAccount.id')->select('Mission.*', 'UserAccount.uname')->get();
        return view('mission', ['mission_info'=>$mission])
                    ->with('i',(request()->input('page',1)-1)*5);  
        
    }

    // Show each row of the data
    public function show($id){
        $mission_Detail = DB::select("select * from Mission WHERE MID = '$id'" );
        $mid = $id;
        $sql = DB::table('Mission')->select('CenterLat', 'CenterLng', 'MRange', 'Patterns')
                ->where('MID','=',$id)->get();
        $sql2 = DB::table('Drone')->leftJoin('DroneMission', 'Drone.DroneID', '=', 'DroneMission.DroneID')
        ->where('DroneMission.MID', '=', $id)
        ->get();
        $drone = sizeof($sql2);
        $pattern = $sql->pluck('Patterns')[0];
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
    function getwaypoin($drone, $lat, $lon, $radius){
        $all_waypoint = [];
            $waypoint1 = [];
            $calculator = new LonLatCalculator;
            $brng = 0;
        switch ($drone) {
            case 1:
                            array_push($waypoint1,Array("Latitude" => $lat, "Longitude" => $lon));
                            $newlon = 0;
                            $newlat = 0;
                            $brng = 225;
    
                            $calculator -> computerThatLonLat($lon, $lat, $brng, $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 0;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 90;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 180;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 90;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
    
                            $brng = 0;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius );
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 90;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 180;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 90;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 0;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius );
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                array_push($all_waypoint,Array("Drone 1" => $waypoint1));
                break;
            case 2:
    
                            array_push($waypoint1,Array("Latitude" => $lat, "Longitude" => $lon));
                            $newlon = 0;
                            $newlat = 0;
                            $brng = 0;
    
                            $calculator -> computerThatLonLat($lon, $lat, $brng, $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 270;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2 );
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 180;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 270;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2 );
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 0;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint1,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
    
                            array_push($all_waypoint,Array("Drone 1" => $waypoint1));
    
                            $waypoint2 = [];
    
                            array_push($waypoint2,Array("Latitude" => $lat, "Longitude" => $lon));
                            $newlon = 0;
                            $newlat = 0;
                            $brng = 180;
    
                            $calculator -> computerThatLonLat($lon, $lat, $brng, $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint2,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 90;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2 );
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint2,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 0;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius );
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint2,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 90;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, $radius / 2 );
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint2,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            $brng = 180;
                            $calculator -> computerThatLonLat($newlon, $newlat, $brng, 2 * $radius);
                            $newlon = $calculator->getLongitude();
                            $newlat = $calculator->getLatitude();
                            array_push($waypoint2,Array("Latitude" => $newlat, "Longitude" => $newlon));
    
                            array_push($all_waypoint,Array("Drone 2" => $waypoint2));
    
                break;
    
        }
        return $all_waypoint;
    }
    // $result = waypoint($lng, $lat, $radius);
    //         if(sizeof($result) > 0){
    //             $json = array("status"=>0, "result"=>$result);
    //         }else{
    //             $json = array("status"=>1);
    //         }
        
        
        if($pattern == '0'){
            $result = waypoint($lng, $lat, $radius);
        }else if($pattern == '1'){
            $result = getwaypoin($drone, $lat, $lng, $radius);
        };
        if(sizeof($result) > 0){
            $json = array("status"=>0, "result"=>$result);
        }else{
            $json = array("status"=>1);
        };

        $json = $json['result'];
        return view('mDetail', ['mDetail' => $mission_Detail[0]],
                                ['wayp' => $json]);
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
        // $data2 = DB::table('Mission')
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
