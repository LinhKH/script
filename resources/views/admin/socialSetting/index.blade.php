@extends('admin.layout')
@section('title','Social Setting')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
            @slot('title') Social Setting @endslot
            @slot('add_btn') <a href="{{url('admin/social-settings/create')}}" class="btn btn-primary btn-sm">Add New</a> @endslot
            @slot('active') Social Setting  @endslot
        @endcomponent
        <!-- /.content-header -->
        <!-- show data table component -->
        @component('admin.components.data-table',['thead'=>
            ['S NO.','Title','Icon','Status','Action']
        ])
            @slot('table_id') social_list @endslot
        @endcomponent
    </div>
    @stop
@section('pageJsScripts')
<!-- DataTables -->
<script src="{{asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/assets/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var table = $("#social_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "social-settings",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '40px'},
            {data: 'title', name: 'title'},
            {data: 'icon', name: 'icon'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
            }
        ]
    });
</script>
@stop