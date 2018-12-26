<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;use Hash;
class user_model extends Model
{

    
    public static function createUser($params){
   		$insert=DB::table('tbl_users')->insert($params);
    	return $insert;
  	}
  	public static function checkLogin($params){
  		// print_r($params).exit;
  		$responce=[];
  		$where_arr=['email'=>$params['uname']];
  		$record=DB::table('tbl_users')
  		         ->select('email','password')
  				->where($where_arr)
  				->first();

  		if(empty($record)){
  			
			$responce['success']=false;
			$responce['message']='authanticattion failed,plz check userid';
  		}
  		else{

  			$psw=Hash::check($params['psw'] ,$record->password);
			dd($psw);
			if($psw==true){
				$responce['success']=true;
				$responce['data']=$result;
				$responce['message']='login success';
			}
			else{
				$responce['success']=false;
				$responce['message']='authanticattion failed,plz enter valikd credintials';
			}
  		}
  		return $responce;
  	}
}
