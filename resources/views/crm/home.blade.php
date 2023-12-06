@extends('layouts.crm')
@section('title', app_trans('default.dashboard'))

<style>
    .card {
        margin-top: 2em;
    }

    .card-agric {
        background-color: #4CAF50; /* Green */
        color: white;
    }

    .card-investors {
        background-color: #2196F3; /* Blue */
        color: white;
    }

    .card-deals {
        background-color: #FFC107; /* Yellow */
        color: white;
    }

    .card-open-deals {
        background-color: #E91E63; /* Pink */
        color: white;
    }

    .card-close-deals {
        background-color: #673AB7; /* Purple */
        color: white;
    }

    .card-won-deals {
        background-color: #FF5722; /* Orange */
        color: white;
    }

    .card-proposals {
        background-color: #9E9E9E; /* Grey */
        color: white;
    }
</style>
@section('contents')
    
    <div class="row" style="padding:2em">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body card-agric">
                    <h5 class="card-title">Total Agric Business</h5>
                    <p class="card-text">{{ $data['total_number_of_agric_business'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body card-investors">
                    <h5 class="card-title">Total Investors</h5>
                    <p class="card-text">{{ $data['total_number_of_investors'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body card-deals">
                    <h5 class="card-title">Total Deals</h5>
                    <p class="card-text">{{ $data['total_number_deals'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body card-open-deals">
                    <h5 class="card-title">Total Open Deals</h5>
                    <p class="card-text">{{ $data['total_number_of_deals_open'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body card-close-deals">
                    <h5 class="card-title">Total Close Deals</h5>
                    <p class="card-text">{{ $data['total_number_of_deals_close'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body card-won-deals">
                    <h5 class="card-title">Total Won Deals</h5>
                    <p class="card-text">{{ $data['total_number_of_deals_won'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body card-proposals">
                    <h5 class="card-title">Total Proposals</h5>
                    <p class="card-text">{{ $data['total_number_of_proposals'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Add similar cards for other data points as needed -->
@endsection
