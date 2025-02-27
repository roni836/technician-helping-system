<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Problem;
use App\Models\Brand;
use App\Models\ModelNo;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(){
        $users = User::where('is_admin',0)->count();
        return view('admin.dashboard',compact('users'));
    }

    public function manageDevices(){
        $devices = Device::all();
        return view("admin.manage_devices", compact("devices"));
    }
    public function manageProblems(){
        $problems = Problem::all();
        return view("admin.manage_problems", compact("problems"));
    }

    public function manageBrands(){
        $brands = Brand::all();
        return view("admin.manage_brands", compact("brands"));
    }
    public function manageModelNos(){
        $modelnos = ModelNo::all();
        return view("admin.manage_modelnos", compact("modelnos"));
    }

    public function index(){
        $users =User::where('is_admin',0)->get();
        return view('admin.users',compact('users'));
    }


    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update($request->except('_token'));

    return redirect()->route('admin.users')->with('success', 'User updated successfully');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users')->with('success', 'User deleted successfully');
}


}
