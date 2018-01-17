@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-1 col-sm-2 col-xs-12">
                <ul class="nav nav-pills nav-stacked">
                    {{--todo 后面可以做一个隐藏的效果--}}
                    {{--<li role="presentation" class="hide-text">--}}
                    {{--<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>--}}
                    {{--</li>--}}
                    <li role="presentation" :class="this.$store.state.defaultSelected == 0 ? 'active' : ''">
                        <a href="#">
                            <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 未分类
                            <span class="badge">99+</span>
                        </a>
                    </li>

                    @foreach($boxes as $box)

                        <box-li title="{{$box['title']}}" id="{{$box['id']}}"
                                passwords="{{$box['passwords']}}" icon="{{$box['icon']}}"></box-li>

                    @endforeach


                    <li role="presentation">
                        <a href="#">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 已删除
                        </a>
                    </li>

                    <box-add></box-add>

                    {{--modal框--}}
                    <box-modal :types="{{json_encode($types)}}"></box-modal>
                </ul>
            </div>

            <div class="col-md-11 col-sm-10">
                <example-component name="nine"></example-component>
            </div>
        </div>
    </div>

@endsection
