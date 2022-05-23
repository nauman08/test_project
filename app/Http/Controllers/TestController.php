<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $users = User::all();
        return view('adminHome')->with('users' , $users);
    }

    public function removeUser(Request $req)
    {
        User::find($req->id)->delete();
        $users = User::all();
        return redirect()->back()->with('users' , $users);
    }

    public function adminReg(Request $req)
    {
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'is_admin' => 1,
        ]);

        $users = User::all();
        return redirect()->back()->with('users' , $users);
    }

    public function solution(Request $req)
    {
        $arr = [250 , 500 , 1000 , 2000 , 5000];
        $order = $req->fidget;

        $temp = array();
        $arr2 = array();
        $resultArr = array();
        $x = '';
        $chunk_size = 0;

        // dd(array_search($order , $arr));

        if(array_search($order , $arr) !== false){
            $index = array_search($order , $arr);
            array_push($resultArr , $arr[$index]);
            return $resultArr;
        }


        $sets = $order/250;
        $sets = (int) ++$sets;

        for($i=0; $i<$sets; $i++){
            array_push($temp , 250);
        }


        // ///////////////////////////////////////

        // handling of 5000

        while(array_search($x , $arr) !== false){

            if(sizeof($temp) >= 2){
                $chunk_arr = [$temp[0],$temp[1]];
                $x = array_sum($chunk_arr);
                if(array_search($x , $arr) !== false){
                    $chunk_size = 2;
                    // array_chunk
                }else{
                    $chunk_arr = [$temp[0],$temp[1],$temp[2]];
                    $x = array_sum($chunk_arr);
                    if(array_search($x , $arr)){
                        $chunk_size = 3;
                    // array_chunk
                    }
                }
            }else{
                array_push($resultArr , $temp[0]);
                // return $resultArr;
            }


            $newArray = array_chunk($temp, $chunk_size);

            for($j=0; $j<sizeof($newArray); $j++){
                
                if(sizeof($newArray[$j]) == 2){
                    $sum = array_sum($newArray[$j]);
                    array_push($arr2, $sum);
                }else{
                    array_push($arr2,$newArray[$j][0]);
                }

                $temp = $arr2;                
            }

            $chunk_arr = [$temp[0],$temp[1]];
            $x = array_sum($chunk_arr);
    
        }


        dd($temp);

        ////////////////////////////////////////////

        // 13  = //  6 (500) + 1  //  3 (1000) + 0 + 1 // 1 (2000) + 1 + 0 + 1 //
    }
}