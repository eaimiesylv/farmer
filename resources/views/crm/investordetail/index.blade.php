@extends('layouts.crm')
@section('title', 'Investor Detail')
@section('contents')
<!--<app-contact-person></app-contact-person>-->
 <h5>Investor Records</h5>
<div class="container table-responsive agriInvest_container" style="">
   
    <table class="table table-responsive">
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
                        <td>{{ $record->finance_institution }}</td>
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