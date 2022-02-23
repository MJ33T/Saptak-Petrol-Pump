<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    function login(Request $req){
        $user = User::where(['username'=>$req->username])->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return "User Name and Password not matched";
        }
        else{
            if($user->role == "admin"){
                $req->session()->put('user', $user);
                return redirect('admin_dash');
            }else if($user->role == "user"){
                $req->session()->put('user', $user);
                return redirect('user_dash');
            }
        }
        
    }
}