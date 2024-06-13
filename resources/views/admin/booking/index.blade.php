@extends('admin.layout')
@section('title', 'Booking Log')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @component('admin.components.content-header', ['breadcrumb' => ['Dashboard' => 'admin/dashboard']])
                @slot('title')
                    Booking Log
                @endslot
                @slot('add_btn')
                @endslot
                @slot('active')
                    Booking Log
                @endslot
            @endcomponent
            <!-- show data table component -->
            @component('admin.components.data-table', [
                'thead' => ['S NO.', 'UserName', 'PlanName', 'Seat - Price', 'Departure Time'],
            ])
                @slot('table_id')
                    booking
                @endslot
            @endcomponent
        @stop
        @section('pageJsScripts')
            <!-- DataTables -->
            <script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('public/assets/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('public/assets/js/responsive.bootstrap4.min.js') }}"></script>
            <script type="text/javascript">
                var table = $("#booking").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "booking",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            sWidth: '40px'
                        },
                        {
                            data: 'user_name',
                            name: 'user'
                        },
                        {
                            data: 'plan_name',
                            name: 'plan'
                        },
                        {
                            data: 'seats',
                            name: 'seat'
                        },
                        {
                            data: 'created_at',
                            name: 'date'
                        },
                        // {
                        //     data: 'action',
                        //     name: 'action',
                        //     orderable: true,
                        //     searchable: true,
                        //     sWidth: '100px'
                        // }
                    ]
                });
            </script>
        @stop
