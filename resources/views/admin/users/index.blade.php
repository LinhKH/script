@extends('admin.layout')
@section('title','Users')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Users @endslot
            @slot('add_btn')  @endslot
            @slot('active') Users  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Image','User','Email','Country','Joined At','Status','Action']
        ])
            @slot('table_id') user-list @endslot
        @endcomponent
    @stop
@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#user-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "users",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'image', name: 'image'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'country', name: 'country'},
            {data: 'created_at', name: 'date'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
                sWidth: '100px'
            }
        ]
    });
</script>
@stop