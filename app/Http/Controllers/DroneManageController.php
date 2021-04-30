<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DroneManageController extends Controller
{
    public function index()
    {
        $users = DB::select('select * from Drone ', [1]);
        return view('drone.view', ['drone' => $users]);
    }

    public function create()
    {
        if(auth()->user()->Role=='admin'){
            return view('drone.create');
        } else{
            abort(403);
        }
        
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'SerialNum' => 'required|max:255',
        ]);
        $user = DB::table('Drone')->insert([
            'DSerialNumber' => $storeData['SerialNum'],
            'DStatus' => 0,
        ]);

        return redirect('/drone')->with('completed', 'Drone has been saved!');
    }

    public function edit($DroneID)
    {
        if(auth()->user()->Role=='admin'){
            $user = DB::select("select * from Drone WHERE DroneID = '$DroneID'" );
            return view('drone.edit', ['drone' => $user[0]]);
        } else {
            abort(403);
        }
        
    }

    public function update(Request $request, $DroneID)
    {
        $updateData = $request->validate([
            'SerialNum' => 'required|max:255',
        ]);
        DB::table('Drone')->where('DroneID', $DroneID)->update([
            'DSerialNumber' => $updateData['SerialNum'],
        ]);
        return redirect('/drone')->with('completed', 'Drone has been updated');
    }

    public function destroy($DroneID)
    {
        if(auth()->user()->Role=='admin'){
            $user = DB::table('Drone')->where('DroneID', $DroneID)->delete();
            return redirect('/drone')->with('completed', 'User has been deleted');
        } else {
            abort(403);
        }
        
    }
}
