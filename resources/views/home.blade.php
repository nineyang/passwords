@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="nav nav-pills nav-stacked col-md-10">
                            {{--todo 后面可以做一个隐藏的效果--}}
                            {{--<li role="presentation" class="hide-text">--}}
                            {{--<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>--}}
                            {{--</li>--}}

                            <box-li title="未定义" id="0"
                                    passwords="{{$unclassified_count}}" icon="time"></box-li>

                            @foreach($boxes as $box)

                                <box-li title="{{$box['title']}}" id="{{$box['id']}}"
                                        passwords="{{$box['passwords']}}" icon="{{$box['icon']}}"></box-li>

                            @endforeach

                            <box-li title="已删除" id="deleted"
                                    passwords="{{$deleted_count}}" icon="trash"></box-li>

                            <box-add></box-add>

                            {{--modal框--}}
                            <box-modal :types="{{json_encode($types)}}"></box-modal>
                        </ul>

                    </div>
                </div>

            </div>

            <div class="col-md-10 col-sm-10">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-sm-2 col-md-2">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Title</h4>
                                    <p>Account</p>
                                    <p class="pull-right">
                                        <button type="button" class="btn btn-default btn-xs">
                                            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 编辑
                                        </button>
                                        <button type="button" class="btn btn-default btn-xs">
                                                <span class="glyphicon glyphicon-share-alt"
                                                      aria-hidden="true"></span> 跳转
                                        </button>
                                        <button type="button" class="btn btn-default btn-xs">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 删除
                                        </button>
                                    </p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>

            </div>

            <home-plus></home-plus>


        </div>
    </div>

@endsection
