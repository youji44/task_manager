@extends('layouts.layout')

{{-- Page title --}}
@section('title')
    Task Management
@stop
{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/nestable2/jquery.nestable.css') }}">

    <style>
        /*Nestable*/
        .dd-handle {
            @extend .form-control;
            height: auto;
            font-weight:400;
            margin: 0 0 15px;
            font-size:14px;
            background:transparent;
            color: grey;
            &:hover,&:focus,&:active {
                color:black;
            }
        }
        .dd-item > button {
            margin:0;
            height:42px;
        }

        .dd3-content {
            display: block;
            height: auto;
            margin: 5px 0;
            padding: 5px 10px 5px 60px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-dragel > .dd3-item > .dd3-content {
            margin: 0;
        }

        .dd3-item > button {
            margin-left: 30px;
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 52px;
            height: 52px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 13px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 38px;
            font-weight: normal;
        }

        .dd3-handle:hover {
            background: #ddd;
        }

    </style>
@stop

{{-- Page content --}}
@section('content')
    <div class="header-area">
        <div class="row align-items-center">
            <!-- nav and search button -->
            <div class="col-md-12 col-sm-12 clearfix">
                <div class="nav-btn pull-left">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="search-box pull-left">
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Task Management</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-2">
            <a class="btn btn-success btn-sm" onclick="show_detail('{{route('task.add','0')}}')" href="javascript:"><i class="ti-plus"></i> Add New</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-2">
            <div class="card">
                <div class="card-body">
                    @include('notifications')
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach($task as $key=>$item)
                                <li class="dd-item" data-id="{{$item->id}}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span class="font-weight-bold">{{ $item->task_name }}</span>
                                            <div style="display: flex; align-items: center;">
                                                <span style="margin-left: 20px;">{{ $item->date . ' ' . $item->time }}</span>
                                                <button class="btn btn-primary btn-sm"
                                                        onclick="show_detail('{{ route('task.add', $item->id) }}')"
                                                        style="margin-left: 10px;">
                                                    <i class="ti-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                        style="margin-left: 10px;"
                                                        onclick="delete_task('{{route('task.delete')}}','{{$item->id}}')">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="inspect_detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="inspect_title" class="modal-title">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div id="inspect_body" class="modal-body" style="min-height: 240px">
                </div>
            </div>
        </div>
    </div>
    <div id="print_body" style="display: none"></div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/nestable2/jquery.nestable.js') }}"></script>
    <script>

        function show_detail(url){
            $.get(url, function (data) {
                $("#inspect_title").html($(".page-title").html());
                $("#inspect_body").html(data);
                $("#inspect_detail").modal('show');
            });
        }
        function delete_task(url,id) {
            if (confirm('Are you sure you want to delete this task?')) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { id: id },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('li[data-id="' + id + '"]').remove();
                    },
                    error: function(error) {
                        console.log(error)
                        alert('Failed to delete the task.');
                    }
                });
            }
        }

        $("#month").datepicker( {
            format: "M yyyy",
            viewMode: "months",
            minViewMode: "months"
        });

        function set_month() {
            $("#form_month").submit();
        }

        $(document).ready(function(){
            "use strict";
            $('#nestable').nestable({
                group: 1
            }).on('change', function (){
                $.post('{{route('task.change')}}',
                    {_token:'{{csrf_token()}}', tasks:$('#nestable').nestable('serialize')}, function (res){
                        if(res.success){
                            $.toast().reset('all');
                            $("body").removeAttr('class');
                            $.toast({
                                heading: 'Success',
                                text: 'You changed a task priority.',
                                position: 'top-right',
                                loaderBg:'#3e93ff',
                                icon: 'success',
                                hideAfter: 2000,
                                stack: 6
                            });
                        }
                });
            });
        });


    </script>
@stop
