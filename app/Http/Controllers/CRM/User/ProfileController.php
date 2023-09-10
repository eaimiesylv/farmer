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
       //reads user detail either agri business or investor detail
       
        $user=\App\Models\Core\Auth\User::find($id);
        if($user){
           $agriBusiness_investor_detail=$user->load('roles:id,name', 
                                            'profile:id,user_id,gender,date_of_birth,address,contact',
                                            'profilePicture', 'status:id,name,class',
                                            'investor_detail',
                                            'agricbusiness_detail',
                                            'document');
                                          
            return view('auth.profile')->with('detail',$agriBusiness_investor_detail);
        }
        
        // 
    }
}
