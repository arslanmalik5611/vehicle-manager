@extends('layout.master')
@section('page_title','Home')
​
@section('content')
<style>
    #lab-name {
        font-size: 40px;
        font-weight: bold;
    }

    #lab-desc {
        font-size: 17px;
    }

    .demo-bg {
        width: 100%;
    }
</style>

<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-home fa-icon"></i> Home </h2>
            </div>
            <div>
                <a href="#" class="btn btn-outline-secondary btn-sm logout">Logout</a>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive" style="padding: 0 !important;overflow: hidden">
        <div class="row justify-content-center; align-items-center">
            <div class="col-md-5 text-center">
                <h5><b>{{$Setting->home_title}}</b></h5>
                <!-- <img
                        class="demo-bg"
                        src="{{asset('panel_assets/images/logo.png')}}"
                        style="width: 100%"
                    > -->
                <div id="lab-name">{{env('LAB_NAME')}}</div>
                <div id="lab-desc-strings">
                    <p>{!!$Setting->home_description!!}</p>
                </div>
                <span id="lab-desc"></span>

            </div>
            <div class="col-md-7">
                <div>
                    <img class="demo-bg" src="{{$Setting->home_image}}" alt="">
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
​
@section('page_level_scripts')
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    $(document).ready(function() {
        var typed = new Typed('#lab-desc', {
            stringsElement: '#lab-desc-strings',
            typeSpeed: 100

        });
    });
</script>
@endsection