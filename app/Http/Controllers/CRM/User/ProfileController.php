<?php

namespace App\Http\Controllers\CRM\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        //return 'something went wrong';
       return view('auth.profile')->with('detail',null);
    }
    public function agriBusinessDetail($id, $type){
       
        $user=\App\Models\Core\Auth\User::find($id);
        if($user){
           $agriBusinessDetail=$user->load('roles:id,name', 
                                            'profile:id,user_id,gender,date_of_birth,address,contact',
                                            'profilePicture', 'status:id,name,class',
                                            'investor_detail',
                                            'agricbusiness_detail');
                                            
            return view('auth.profile')->with('detail',$agriBusinessDetail);
        }
        
        // 
    }
}
