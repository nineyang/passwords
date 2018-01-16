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
                    <li role="presentation" class="active">
                        <a href="#">
                            <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 未分类
                            <span class="badge">99+</span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 工作
                            <span class="badge">4</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#">
                            <span class="glyphicon glyphicon-book" aria-hidden="true"></span> 学习
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#">
                            <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> 生活
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#">
                            <span class="glyphicon glyphicon-headphones" aria-hidden="true"></span> 娱乐
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#">
                            <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 自定义
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 已删除
                        </a>
                    </li>

                    <box-li></box-li>

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
