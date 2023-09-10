<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\AgricBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AgricBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=Auth::user()->role;
        $matchingRecords=[];
       
        if($type == 4){
            //get all categories related to this investor
          $investmentType= \App\Models\InvestorDetail::select('id','investment_type')->where('user_id', Auth::user()->id)->first();
          if(is_null($investmentType)){
          
            return view('crm.agribusiness.index')->with('matchingRecords', $matchingRecords);
          }
        
            $namesToSearch=$investmentType->investment_type;
            //select all agric businesses in this category
            $matchingRecords = \App\Models\AgricBusiness::where(function ($query) use ($namesToSearch) {
                    foreach ($namesToSearch as $name) {
                        $query->orWhereJsonContains('preferredValueChain', $name);
                    }
                })->get();
          
          
        }
        else if($type == 1){
            //$type 1 is admin type
            $matchingRecords = \App\Models\AgricBusiness::all();
        }
        
        $matchingRecords->load('user');
        return view('crm.agribusiness.index')->with('matchingRecords', $matchingRecords);

       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
             
                'dynamicComponentData.dealDescription' => 'required|string|max:255',
                'dynamicComponentData.dealName' => 'required|string|max:255',
                'dynamicComponentData.dealPromoters' => 'required|string|max:255',
                'dynamicComponentData.focalStates' => 'required|string|max:255',
                'dynamicComponentData.hasBusinessPlan' => 'required|string|in:Yes,No',
                'dynamicComponentData.organizationName' => 'required|string|max:255',
                'dynamicComponentData.preferredValueChain' => 'required|array',
                'dynamicComponentData.preferredValueChain.*' => 'required|string|max:255',
                'dynamicComponentData.purpose' => 'required|string|max:255',
                'dynamicComponentData.raiseAmount' => 'required|string|max:255',
                'dynamicComponentData.ticketSize' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
            }

            // Validation passed, you can now insert the data into the users table
            // ...

            return response()->json(['success' => true, 'message' => 'Registration successful'], 200);
        }

   
    public function stored(Request $request)
    {
        return 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AgricBusiness  $agricBusiness
     * @return \Illuminate\Http\Response
     */
    public function show(AgricBusiness $agricBusiness)
    {
         return 'related agric business';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AgricBusiness  $agricBusiness
     * @return \Illuminate\Http\Response
     */
    public function edit(AgricBusiness $agricBusiness)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AgricBusiness  $agricBusiness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgricBusiness $agricBusiness)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AgricBusiness  $agricBusiness
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgricBusiness $agricBusiness)
    {
        //
    }
}
