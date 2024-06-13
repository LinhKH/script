@extends('admin.layout')
@section('title','Blog Category')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Blog Category @endslot
            @slot('add_btn') <a href="{{url('admin/b-category/create')}}" class="btn btn-primary btn-sm">Add New</a> @endslot
            @slot('active') Blog Category @endslot
        @endcomponent
        <div class="row">
            <div class="col-md-12">
                <!-- show data table component -->
                @component('admin.components.data-table',['thead'=>
                    ['S NO.','Category Name','Status','Action']
                ])
                    @slot('table_id') BlogCat-list @endslot
                @endcomponent
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@stop
@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#BlogCat-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "b-category",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'category'},
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