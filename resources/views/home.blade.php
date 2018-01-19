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

                            {{--<box-li title="未分类" id="0"--}}
                                    {{--passwords="{{$unclassified_count}}" icon="time"></box-li>--}}

                            @if(!empty($boxes))
                                @foreach($boxes as $box)

                                    <box-li title="{{$box['title']}}" id="{{$box['id']}}"
                                            passwords="{{$box['passwords']}}" icon="{{$box['icon']}}"></box-li>

                                @endforeach
                            @endif

                            <box-li title="已删除" id="deleted"
                                    passwords="{{$deleted_count}}" icon="trash"></box-li>

                            <box-add></box-add>

                            {{--modal框--}}
                            <box-modal :types="{{json_encode($types)}}"></box-modal>

                            <password-modal :safety_levels="{{json_encode(config('password.level'))}}"
                                            :boxes="{{json_encode($boxes)}}"></password-modal>
                        </ul>

                    </div>
                </div>

            </div>

            <div class="col-md-10 col-sm-10">
                <common-panel v-show="this.$store.state.selected == 0" name="{{auth()->user()->name}}"></common-panel>
                <div class="container-fluid" v-show="this.$store.state.selected != 0">
                    <div class="row">

                        {{--foreach password list--}}
                        <password-caption></password-caption>

                    </div>


                </div>

            </div>

            <home-plus></home-plus>


        </div>
    </div>

@endsection
