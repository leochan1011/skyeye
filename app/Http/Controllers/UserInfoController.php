<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserInfoController extends Controller
{
    public function self($name,$pw){
        
        //$user = User::where([['name', $name]])->get();
        
        $login = DB::table('users')->where([['name', $name]]);
        //$passw = $login->addSelect('password')->get()->keyBy('password');
        $aa = $login->get()->pluck('password')->toArray();
        
        if(hash::check($pw,$aa[0])){

            return $login->get();
        };
        
        //return response()->json($user);
    }
    public function index()
    {
        // $users = DB::select('select * from users ', [1]);
        // return view('user_info', ['users' => $users]);
        $user = User::all();
        return view('index',compact('user'));

    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|max:5',
            'sid' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        $user = User::create([
            'name' => $storeData['name'],
            'password' => Hash::make($storeData['password']),
            'sid' => $storeData['sid'],
            'role' => $storeData['role'],
        ]);

        return redirect('/users')->with('completed', 'User has been saved!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'sid' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        User::whereId($id)->update([
            'name' => $updateData['name'],
            'password' => Hash::make($updateData['password']),
            'sid' => $updateData['sid'],
            'role' => $updateData['role'],
        ]);
        return redirect('/users')->with('completed', 'User has been updated');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('completed', 'User has been deleted');
    }
}
