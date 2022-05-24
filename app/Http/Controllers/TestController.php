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
        $divisor = 0;
        $result = array();
        $loop = sizeof($arr) - 1;

        for($i=$loop; $i>0; $i--){
            $divisor = $order/$arr[$i];
            if(floor($divisor) > 0){
                for($j=0; $j<floor($divisor); $j++){
                    array_push($result,$arr[$i]);
                }
            }

            $order = $order%$arr[$i];
        }

        if($order > 0){
            array_push($result,250);
        }

        

        dd($result);


        // the case for 1390 or 1800 ,  1000 in divisor , 390 should get 500 but divisor giving 390/500 = 0





        $arr = [250 , 500 , 1000 , 2000 , 5000];
        $order = $req->fidget;

        $temp = array();
        $arr2 = array();
        $resultArr = array();
        $x = '';
        $chunk_size = 0;
        $loops = 1 ;

        if(array_search($order , $arr) !== false){
            $index = array_search($order , $arr);
            array_push($resultArr , $arr[$index]);
            return $resultArr;
        }

        $sets = $order/250;
        $sets = ceil($sets);

        for($i=0; $i<$sets; $i++){
            array_push($temp , 250);
        }

        while(ceil($sets/2) != 1){
            $loops++;
            $sets = ceil($sets/2);
        }

        for($j=0; $j<=$loops; $j++){
            if(sizeof($temp) >= 2){
                
                $chunk_arr = [$temp[0],$temp[1]];
                $x = array_sum($chunk_arr);

                if(array_search($x , $arr) !== false){
                    $chunk_size = 2;
                }else{
                    if(sizeof($temp) == 2){
                        // for($m=0; $m<sizeof($temp); $m++)
                        //     array_push($arr2,$temp[$m]);
                    }else{
                        $chunk_arr = [$temp[0],$temp[1],$temp[2]];
                        $x = array_sum($chunk_arr);
                            if(array_search($x , $arr) !== false){
                                $chunk_size = 3;
                            }
                    }                   
                }
            }else{
                // array_push($arr2 , $temp[0]);
            }


            $newArray = array_chunk($temp, $chunk_size);

            for($k=0; $k<sizeof($newArray); $k++){
                
                if(sizeof($newArray[$k]) >= 2){
                    if(array_search(array_sum($newArray[$k]) , $arr) !== false){
                        $sum = array_sum($newArray[$k]);
                        array_push($arr2, $sum);
                    }
                    else{
                        for($m=0; $m<sizeof($newArray[$k]); $m++)
                            array_push($arr2,$newArray[$k][$m]);
                    }
                       
                }else{                   
                    array_push($arr2,$newArray[$k][0]);
                }

                             
            }
           
            $temp = $arr2; 
            $arr2 = [];
                     
        }

        dd($temp);

        ////////////////////////////////////////////

        // 13  = //  6 (500) + 1  //  3 (1000) + 0 + 1 // 1 (2000) + 1 + 0 + 1 //
    }
}