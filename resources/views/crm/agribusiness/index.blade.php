@extends('layouts.crm')
@section('title', 'Agri business')
@section('contents')
<!--<app-agric-person></app-agric-person>-->
<div class="row spacing1">
    <div class="col-md-12 mt-4">
        <h5 class="btn btn-warning">Agribusiness</h5>
    </div>
    <div class="col-md-12 mt-4">
        <div class="d-flex">
            <button class="btn btn-primary btnFormat">
                Organization name
            </button>
            <button class="btn btn-primary btnFormat">
                Created at
            </button>
            <button class="btn btn-primary btnFormat">
                Phone
            </button>

            <!-- Button with Icons -->
            <!-- <button class="btn btn-primary ml-auto">
                <i class="fas fa-search"></i> Search
            </button> -->
        </div>
    </div>
</div>

<div class="row  table-responsive agriInvest_container spacing2">
    
    <table class="table table-striped">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Organization Name</td>
                <td>Deal Name</td>
                <td>Promoters</td>
                <td> Description</td>
                <td>Value Chain</td>
                <!--<td>Business Plan</td>
                <td>Focal States</td>
                <td>Ticket Size</td>
                <td>Raise Amount</td>
                <td>Purpose</td>
               
                <td>Other Value Chains</td>
               
               
                <td>Fullname</td>-->
                <td>Contact Person</td>
                <td>Phone Number</td>
            </tr>
        </thead>
        <tbody>
            @if (count($matchingRecords) > 0)
              @php $i=1 @endphp
                @foreach ($matchingRecords as $record)
                    <tr class="">
                        <td>{{ $i++}}</td>
                        <td><a href="/admin/user_detail/{{$record->user->id}}/agri_business">{{ $record->organizationName }}</a></td>
                        <td>{{ $record->dealName }}</td>
                        <td>{{ $record->dealPromoters }}</td>
                        <td>{{ $record->dealDescription }}</td>
                        <td>{{ implode(', ', $record->preferredValueChain) }}</td>
                        <!--<td>{{ $record->hasBusinessPlan }}</td>
                        <td>{{ $record->focalStates }}</td>
                        <td>{{ $record->ticketSize }}</td>
                        <td>{{ $record->raiseAmount }}</td>
                        <td>{{ $record->purpose }}</td>
                        
                        <td>{{ $record->otherValueChains }}</td>-->
                       
                        @if ($record->user)
                           
                           <!-- <td>{{ $record->user->fullname }}</td>-->
                            <td>{{ $record->user->contact_person }}</td>
                            <td>{{ $record->user->phone_number }}</td>
                        @else
                            <td colspan="5">No User</td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="18">No records found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection