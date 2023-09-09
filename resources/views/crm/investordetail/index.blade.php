@extends('layouts.crm')
@section('title', 'Agri business')
@section('contents')
<!--<app-agric-person></app-agric-person>-->
<div class="row spacing1">
    <div class="col-md-12 mt-4">
        <h5 class="btn btn-success">Investor</h5>
    </div>
    <div class="col-md-12 mt-4">
        <div class="d-flex">
            <button class="btn btn-primary btnFormat">
                Finance Institution
            </button>
            <button class="btn btn-primary btnFormat">
                Created at
            </button>
            <button class="btn btn-primary btnFormat">
                Phone
            </button>

            <!-- Button with Icons -->
            <button class="btn btn-primary ml-auto">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
    </div>
</div>

<div class="row  table-responsive agriInvest_container spacing2">
    
   
    <table class="table table-striped">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Finance Institution</td>
                    <td>Funding Type</td>
                    <td>Fullname</td>
                    <td>Contact Person</td>
                    <td>Phone Number</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                @if (count($matchingRecords) > 0)
                @php $i=1 @endphp
                    @foreach ($matchingRecords as $record)
                        <tr>
                            <td>{{ $i++}}</td>
                            <td><a href="/admin/user_detail/{{$record->user->id}}/agri_business">{{ $record->finance_institution }}</a></td>
                            <td>{{ $record->funding_type }}</td>
                            
                        
                        
                            @if ($record->user)
                            
                                <td>{{ $record->user->fullname }}</td>
                                <td>{{ $record->user->contact_person }}</td>
                                <td>{{ $record->user->phone_number }}</td>
                                <td>{{ $record->user->email }}</td>
                            @else
                                <td colspan="5">No User</td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No records found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
</div>
@endsection