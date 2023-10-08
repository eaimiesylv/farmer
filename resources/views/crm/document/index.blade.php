@extends('layouts.crm')
@section('title', 'Document')
@section('contents')
<!--<app-agric-person></app-agric-person>-->
<div class="row spacing1">
    <div class="col-md-12 mt-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#createPitchModal">
            <i class="fas fa-plus"></i> Create Pitch
        </button>
    </div>
    <div class="col-md-12 mt-4">
        <div class="d-flex">
        @if( Auth::user()->role == 3)
            <button class="btn btn-primary btnFormat">
                List of Created Pitch 
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
                <td>Pitch Name</td>
                <td>Pitch Type</td>
                <!-- <td>Action</td> -->
              
            </tr>
        </thead>
        <tbody>
            @if (count($matchingRecords) > 0)
              @php $i=1 @endphp
                @foreach ($matchingRecords as $record)
                    <tr class="">
                        <td>{{ $i++}}</td>
                        <td>{{ $record->pitchname }}</td>
                        <td>{{ $record->pitchtype }}</td>
                        <!-- <td>
                            <a href="{{ url($record->pitchfile) }}" target="_blank">
                                <i class="fas fa-eye"></i>
                            </a>
                            <i class="fas fa-trash" style="color:red;margin:0 1em;"></i>
                            <i class="fas fa-pen" style="color:green"></i>
                        </td> -->
                       
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">No records found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>


@include('crm.document.create_pitch_modal')
@endsection


