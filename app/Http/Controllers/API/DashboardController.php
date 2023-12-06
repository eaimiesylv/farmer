<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // default value
        $total_number_deals = 0;
        $total_number_of_deals_open=0;
        $total_number_of_deals_close=0;
        $total_number_of_deals_won=0;
        $total_number_of_proposals=0;
        $total_number_of_agric_business =0;
        $total_number_of_investors = 0;
        $type=Auth::user()->role;
       // 1--count number of agric business:count  from users where role is 3
       $total_number_of_agric_business =10;
       // 2-- count number of investors: count from users where role is 4
       $total_number_of_investors =5;
       
        // count deals
        if($type == 3){
          // agric business
             // count number of created deals::open close and won per individuals: count from manage_deal where user_id: auth
             // count from proposal where user_id
             $total_number_deals = 10;
             $total_number_of_deals_open=6;
             $total_number_of_deals_close=5;
             $total_number_of_deals_won=4;
             $total_number_of_proposals=4;
        }
        else if($type == 4){
            // investor
            //investor proposal; count from manage_deal where id in deal_proposal
             // count number of created deals::open close and won per individuals: count from manage_deal where investor_id
             $total_number_deals = 10;
             $total_number_of_deals_open=6;
             $total_number_of_deals_close=5;
             $total_number_of_deals_won=4;
             $total_number_of_proposals=4;
        }
        else if($type == 1){
            
            $total_number_deals = 10;
            $total_number_of_deals_open=6;
            $total_number_of_deals_close=5;
            $total_number_of_deals_won=4;
            $total_number_of_proposals=4;
        }
        $data=[
            "total_number_of_agric_business"=>$total_number_of_agric_business,
            "total_number_of_investors"=>$total_number_of_investors,
            "total_number_deals"=>$total_number_deals,
            "total_number_of_deals_open"=>$total_number_of_deals_open,
            "total_number_of_deals_close"=>$total_number_of_deals_close,
            "total_number_of_deals_won"=>$total_number_of_deals_won,
            "total_number_of_proposals"=>$total_number_of_proposals,
        ];
        return view("crm.home")->with('data', $data);
       
    }

    
}
