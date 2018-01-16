@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Star
            <div class="col-md-1 col-sm-2 col-xs-12">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                    <li role="presentation"><a href="#">Profile</a></li>
                    <li role="presentation"><a href="#">Messages</a></li>
                </ul>
            </div>

            <div class="col-md-11 col-sm-10">hello,world</div>
        </div>
    </div>

@endsection
