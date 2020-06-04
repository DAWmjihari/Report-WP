@extends('layouts.app')

@section('content')
<div id="welcomeHome" class="container animate__animated animate__fadeInLeft animate__delay-1s">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="container jumbotron card">
                <div class="container">
                    <h1 class="display-4">{{ __('home.welcome') }}, {{ Auth::user()->display_name }}</h1>
                    <hr>
                    <p class="lead">
                        {{ __('home.info',['company' => App\Option::where('option_name', 'blogname')->value('option_value')]) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container animate__animated animate__fadeInUp animate__delay-1s">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('home.dashboard') }}</div>
                <div class="card-body">
                    <div id="messageOkey"
                        class="alert alert-success animate__animated animate__bounce animate__repeat-3" role="alert"
                        style="display: none">
                        <strong>{{ __('alerts.success') }}</strong> {{ __('alerts.msg_success') }}
                    </div>
                    <div id="messageInfo" class="alert alert-info animate__animated animate__shakeX" role="alert"
                        style="display: none">
                        <strong>{{ __('alerts.info') }}</strong> {{ __('alerts.msg_info') }}
                    </div>
                    <div id="messageError" class="alert animate__animated alert-danger animate__tada" role="alert"
                        style="display: none">
                        <strong>{{ __('alerts.error') }}</strong> {{ __('alerts.msg_error') }}
                    </div>
                    <p>{{ __('home.info2') }}</p>
                    <hr>
                    <form class="row justify-content-center">
                        <div class="input-group mb-2 col-12 col-md-6 col-lg-5 px-3 m-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                            <input class="form-control text-center" type="text" data-toggle="daterangepicker"
                                maxlength="23" name="timestamp" data-filter-type="date-range">
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 px-3">
                            <a href="#" id="btnGenerateReport" class="btn btn-success mb-2 d-block w-100"><i
                                    class="far fa-file-pdf mr-2"></i>{{ __('home.btnGenerate') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
