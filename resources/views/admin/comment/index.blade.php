@extends('admin.layout')
@section('title','Blog Comment')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Blog Comment @endslot
            @slot('add_btn')  @endslot
            @slot('active') Blog Comment  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Blog Name','Comment By','Date','Status','Action']
        ])
            @slot('table_id') comment-list @endslot
        @endcomponent
     
@stop
@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#comment-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "comment",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '10px'},
            {data: 'blog', name: 'blog',sWidth: '100px'},
            {data: 'user', name: 'user'},
            {data: 'created_at', name: 'date'},
            // {data: 'comment', name: 'comment'},
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