<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    public function self($name,$pw){
        
        //$user = User::where([['name', $name]])->get();
        
        $login = DB::table('users')->where([['name', $name]]);
        //$passw = $login->addSelect('password')->get()->keyBy('password');
        $aa = $login->get()->pluck('password')->toArray();
        if($login->count() >0){
            if(hash::check($pw,$aa[0])){

                return json_decode($login->get(),true);
            } else{
                $error = array('status'=>1);
                return $error; 
            }
        } else{
            $error = array('status'=>1);
            return $error;
        }
        
    }
    public function index()
    {
        $users = DB::select('select * from UserAccount ', [1]);
        return view('account.view', ['user' => $users]);
        // $user = User::all();
        //return view('account.view',compact('user'));

    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|max:5',
            'sid' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        $user = DB::table('UserAccount')->insert([
            'uname' => $storeData['name'],
            'password' => Hash::make($storeData['password']),
            'SID' => $storeData['sid'],
            'Role' => $storeData['role'],
        ]);

        return redirect('/users')->with('completed', 'User has been saved!');
    }

    public function show($id)
    {
        //
    }

    public function edit($UserID)
    {
        $user = DB::select("select * from UserAccount WHERE id = '$UserID'" );
        return view('account.edit', ['user' => $user[0]]);
        //$user = User::findOrFail($id);
        //return view('account.edit', compact('user'));
    }

    public function update(Request $request, $UserID)
    {
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'sid' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        DB::table('UserAccount')->where('id', $UserID)->update([
            'uname' => $updateData['name'],
            'PWD' => Hash::make($updateData['password']),
            'SID' => $updateData['sid'],
            'Role' => $updateData['role'],
        ]);
        return redirect('/users')->with('completed', 'User has been updated');
    }

    public function destroy($UserID)
    {
        //$user = DB::table('UserAccount')->findOrFail($UserID);
        $user = DB::table('UserAccount')->where('id', $UserID)->delete();
        //$user->delete();

        return redirect('/users')->with('completed', 'User has been deleted');
    }
}
