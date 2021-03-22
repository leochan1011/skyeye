<?php

namespace App\Http\Controllers\mission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;


class GetMissionController extends Controller
{
    public function get()
    {  
        $sql = DB::table('Mission')->leftJoin('users', 'Mission.MCreator', '=', 'users.id')->select('Mission.*', 'users.name')->get();
        
        //$user = User::where([['name', $name]])->get();
        /*
        $login = DB::table('users')->where([['name', $name]]);
        //$passw = $login->addSelect('password')->get()->keyBy('password');
        $aa = $login->get()->pluck('password')->toArray();
        if($login->count() >0){
            if(hash::check($pw,$aa[0])){

                return json_decode($login->get(),true);
            } else{
                $eeror = array('status'=>1);
                return $eeror; 
            }
        } else{
            $eeror = array('status'=>1);
            return $eeror;
        }
        
        */
        //return response()->json($user);
        echo " ";
    }











}
