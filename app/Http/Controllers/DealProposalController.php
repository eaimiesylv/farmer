<?php

namespace App\Http\Controllers;

use App\Models\DealProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Auth;

class DealProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allDeal= $this->allDeals();
        $user_type=Auth::user()->role;
        if($user_type == 1){
            //admin
            $allProposals= DealProposal::with('deals')->orderby('created_at', 'desc')->get();
            
        }
        else{
           $allProposals= DealProposal::where('user_id', Auth::user()->id)->with('deals')->orderby('created_at', 'desc')->get();
        }
       
      
        return view('crm.dealproposals.index', compact('allProposals', 'allDeal'));
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
            //return $request->all();
            try{
                $request->validate([
                    'title' => 'required|max:50',
                    'description' => 'required|max:300',
                    'deal_id' => 'required|integer', 
                ]);
                
                 DealProposal::create($request->all());
                 return redirect()->route('dealproposals.index')->with('success', 'Proposal created successfully.');
            }
            catch(QueryException $e){
                Log::error('Error storing document: ' . $e->getMessage());
                return redirect()->route('dealproposals.index')->with('errors', 'Deal creation not. Try again');
            } 
    }       
    public function show(DealProposal $dealProposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DealProposal  $dealProposal
     * @return \Illuminate\Http\Response
     */
    public function edit(DealProposal $dealProposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DealProposal  $dealProposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DealProposal $dealProposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DealProposal  $dealProposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(DealProposal $dealProposal)
    {
        //
    }
    protected function allDeals(){
        return \App\Models\ManageDeal::select('id','title','description')
                ->where('user_id', Auth::user()->id)
                ->where('status', 0)
                ->with('proposals')
                ->whereDoesntHave('proposals') 
                ->get();
    }
}
