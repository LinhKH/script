@extends('admin.layout')
@section('title', 'Category')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @component('admin.components.content-header', ['breadcrumb' => ['Dashboard' => 'admin/dashboard']])
                @slot('title')
                    Category
                    {{(Request::path() == 'admin/b-category')? 'active':''}}
                @endslot
                @slot('add_btn')
                    <a href="{{ url('admin/categories/create') }}" class="btn btn-primary btn-sm">Add New</a>
                @endslot
                @slot('active')
                    Category
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-md-12">
                    <!-- show data table component -->
                    @component('admin.components.data-table', ['thead' => ['S NO.', 'Category Name', 'Status', 'Action']])
                        @slot('table_id')
                            category-list
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @stop
    @section('pageJsScripts')
        <!-- DataTables -->
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/js/responsive.bootstrap4.min.js') }}"></script>
        <script type="text/javascript">
            var table = $("#category-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: "categories",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        sWidth: '40px'
                    },
                    {
                        data: 'title',
                        name: 'category'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
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
