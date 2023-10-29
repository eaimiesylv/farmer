@extends('layouts.crm')
@section('title', 'Document')
@section('contents')
<!--<app-agric-person></app-agric-person>-->
<div class="row spacing1">
    <div class="col-md-12 mt-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#createProposalModal">
            <i class="fas fa-plus"></i> Create Proposal
        </button>
    </div>
    <div class="col-md-12 mt-4">
        <div class="d-flex">
        @if( Auth::user()->role == 3)
            <button class="btn btn-primary btnFormat">
                List of Created Proposals 
            </button>
        @endif
           <!--  <button class="btn btn-primary btnFormat">
                Pitch Type
            </button>
            <button class="btn btn-primary btnFormat">
                Created
            </button>

            Button with Icons -->
            <!-- <button class="btn btn-primary ml-auto">
                <i class="fas fa-search"></i> Search
            </button> -->
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
    <table class="table table-striped">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Proposal Title</td>
                <td>Deal Name</td>
                <td>Proposal Description</td>
                
              
            </tr>
        </thead>
        <tbody>
            @if (count($allProposals) > 0)
              @php $i=1 @endphp
                @foreach ($allProposals as $record)
                    <tr class="">
                        <td>{{ $i++}}</td>
                        <td>{{ $record->title }}</td>
                        <td>{{ $record->deals->title }}</td>
                        <td>
                        
                            <a href="#" data-toggle="modal" data-target="#proposalDealModal{{ $record->id }}" data-record="{{ json_encode($record) }}">
                                  
                                  <span class="mr-auto"> <i class="fas fa-eye"></i></span>
                            </a>
                         
                        </td> 
                       
                    </tr>
                   
                    <app-deal-proposal :modal-id="'proposalDealModal' + {{ $record->id }}" :matching-Records="{{ json_encode($record) }}" />
                @endforeach
            @else
                <tr>
                    <td colspan="4">No records found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>


@include('crm.dealproposals.create_proposal_modal', ['deal' => $allDeal])
@endsection


