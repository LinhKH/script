@extends('admin.layout')
@section('title','Blogs')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Blog @endslot
            @slot('add_btn') <a href="{{url('admin/blogs/create')}}" class="btn btn-primary btn-sm">Add New</a> @endslot
            @slot('active') Blog @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Blog Name','Category','Status','Action']
        ])
            @slot('table_id') blog-list @endslot
        @endcomponent
        @stop
@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#blog-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "blogs",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'plan'},
            {data: 'category', name: 'category'},
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