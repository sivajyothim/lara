<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user_model as User;
use Hash;use Session;

class userController extends Controller
{
    
    public function doSignup(Request $request){
        $insert_data=['email'=>$request->email,
                     'password'=>Hash::make($request->password),
                     'created_at'=>date("Y-m-d H:i:s")
                     ];
        User::createUser($insert_data);
    	return redirect('login');
    }
    public function doLogin(Request $request){
        $post_data=$request->all();
        
        $result=User::checkLogin($post_data);
        print_r($result).exit;
        if($result['success'] == true){
            $sess_array=$result['data'];
            Session::put('user_data',$sess_array);
            return redirect('home');
        }
        else{print_r().exit;
            Session::flash('message',$result['message']);
            return redirect('login');
        }
    }

    
}
