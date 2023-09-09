@extends('layouts.crm')
@section('title', app_trans('default.profile').' | '.auth()->user()->full_name)
@section('contents')
    <!--app-my-profile is register in resources/js/crm/crmComponent.js"
    <app-my-profile @if(env('MARKET_PLACE_VERSION')) 
    :market-place-version="{{env('MARKET_PLACE_VERSION')}}" @endif/>
    -->
    
    <app-my-profile @if($detail) :initial-detail="{{ json_encode($detail) }}" @endif />
    
@endsection
