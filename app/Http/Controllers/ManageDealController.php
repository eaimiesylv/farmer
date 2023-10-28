<?php

namespace App\Http\Controllers;

use App\Models\ManageDeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log; 

class ManageDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investor= $this->Investors();
        $user_type=Auth::user()->role;
        if($user_type == 1){
            //admin
            $matchingRecords= ManageDeal::all();
            
        }if($user_type == 3){
            //Agric business
            $matchingRecords= ManageDeal::where('user_id', Auth::user()->id)
                ->with('investor') 
                ->with('proposals') 
                ->get();
        }
        else{
            //
            $matchingRecords= ManageDeal::where('investor_id', Auth::user()->id)->with('agricbusiness','proposals')->get();
        }
       // return $matchingRecords;
        //$matchingRecords=[];
        return view('crm.manage_deal.index', compact('matchingRecords', 'investor'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //return $request->all();
            try{
                $request->validate([
                    'title' => 'required|max:50',
                    'description' => 'required|max:300',
                    'deal_value' => 'required|integer|max:9999999999', 
                ]);
                
                 ManageDeal::create($request->all());
                 return redirect()->route('managedeals.index')->with('success', 'Deal created successfully.');
            }
            catch(QueryException $e){
                Log::error('Error storing document: ' . $e->getMessage());
                return redirect()->route('managedeals.index')->with('errors', 'Deal creation not. Try again');
            } 
    }       

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageDeal  $manageDeal
     * @return \Illuminate\Http\Response
     */
    public function show(ManageDeal $manageDeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageDeal  $manageDeal
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageDeal $manageDeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageDeal  $manageDeal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageDeal $manageDeal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageDeal  $manageDeal
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageDeal $manageDeal)
    {
        //
    }
    protected function investors(){
        $Type= \App\Models\AgricBusiness::select('id','preferredValueChain')->where('user_id', Auth::user()->id)->first();
        if(!is_null($Type)){
        
            $namesToSearch=$Type->preferredValueChain;
            //select all investors in this category
            $matchingRecords = \App\Models\InvestorDetail::select("id","user_id")->where(function ($query) use ($namesToSearch) {
                foreach ($namesToSearch as $name) {
                    $query->orWhereJsonContains('investment_type', $name);
                }
            })->with('user:id,fullname')->get()->map(function($user){
                return [
                    "id" => $user->user->id,
                    "fullname" => $user->user->fullname,
                ];
            });

          return  $matchingRecords;
        }
    }
}
