@extends('layouts.crm')
@section('title', 'Document')
@section('contents')
<!--<app-agric-person></app-agric-person>-->
<div class="row spacing1">
    <div class="col-md-12 mt-4">
    @if( Auth::user()->role == 3)
        <button class="btn btn-success" data-toggle="modal" data-target="#createDealModal">
            <i class="fas fa-plus"></i> Create Deal
        </button>
    @endif
    </div>
    <div class="col-md-12 mt-4">
        <div class="d-flex">
            <button class="btn btn-primary btnFormat">
                List of created deals
            </button>
        </div>
    </div>
</div>


<div class="row  table-responsive agriInvest_container spacing2">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="container-fluid">
        <div class="row">
        @if (count($matchingRecords) > 0)
        
            @foreach ($matchingRecords as $record)  
           
                    
                
            <div class="col-lg-3 col-md-6 col-sm-6 mt-3">
            
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-baseline">
                            <i class="fas fa-user mr-3" style="color: #3498db;"></i> 
                            <h6 class="mr-auto font-weight-bold">{{$record ->title }}</h6> 
                            <h5 class="mr-4 font-weight-bold">....</h5> 
                        </div>
                        <div class="d-flex align-items-baseline mt-4">
                            <i class="fas fa-check-circle mr-3" style="color: brown;"></i> 
                            <span class="mr-auto" >Status</span>
                               
                            <span class="mr-4" style="color:@if ($record->status == 'won')
                                    green;
                                @elseif ($record->status == 'close')
                                    red;
                                @else
                                    blue;
                                @endif"> {{$record ->status}}</span>  
                        </div>
                        <div class="d-flex align-items-baseline mt-4">
                            <i class="fas fa-comments mr-3" style="color:green;"></i> 
                            <a href="#" data-toggle="modal" data-target="#commentDealModal">
                                <span class="mr-auto">Chat</span>
                            </a>
                            

                        </div>
                        <div class="d-flex align-items-baseline mt-4">
                            <i class="fas fa-dollar-sign mr-3"></i> 
                            <span class="mr-auto">Deal Value</span> 
                            <span class="mr-4">$ {{$record ->deal_value }}</span> 
                        </div>
                        <div class="d-flex align-items-baseline mt-4">
                            <i class="far fa-clock mr-3" style="color: red"></i> 
                            <span class="mr-auto"> {{$record ->expected_closing_date }}</span> 
                        </div>
                        <hr>
                        <div class="d-flex align-items-baseline mt-4">
                            <p class="ml-3">
                               <a href="#" data-toggle="modal" data-target="#proposalDealModal{{ $record->id }}" data-record="{{ json_encode($record->proposals[0]) }}">
                                  <span class="mr-auto"> Proposal</span>
                               </a>
                            </p>
                            @if (!empty($record->proposals) && count($record->proposals) > 0)
                              
                                <app-deal-proposal :modal-id="'proposalDealModal' + {{ $record->id }}" :matching-Records="{{ json_encode($record->proposals[0]) }}" />
                            @endif
                        </div>
                    </div>
                </div>
               
                <app-comment-deal :matching-Records="{{ json_encode($record) }}" />


            </div>
            @endforeach
        @else
        
           No records found
                    
        @endif
        </div>
    </div>

</div>

@include('crm.manage_deal.create_deal_modal', ['matchingRecords' => $matchingRecords])
<!-- @include('crm.manage_deal.comment_deal_modal', ['matchingRecords' => $matchingRecords])  -->

@endsection


