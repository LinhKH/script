@extends('admin.layout')
@section('title', 'Add New Plan')
@section('content')
    <div class="main-panel">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @component('admin.components.content-header', [
                'breadcrumb' => ['Dashboard' => 'admin/dashboard', 'Plan' => 'admin/plans'],
            ])
                @slot('title')
                    Add Plan
                @endslot
                @slot('add_btn')
                @endslot
                @slot('active')
                    Add Plan
                @endslot
            @endcomponent
            <form class="form-sample" id="addPlan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Plan Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Plan Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" name="title"
                                                placeholder="Enter your Tour Plan" aria-label="Tour Plan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" name="category" id="categorySelect"
                                                placeholder="Enter your Category Name">
                                                <option value="" selected disabled>Select Category</option>
                                                @if (!empty($category))
                                                    @foreach ($category as $types)
                                                        <option value="{{ $types->id }}">{{ $types->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Location</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" name="location" id="locationSelect"
                                                disabled placeholder="Enter your Tour Location Name">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Duration</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" name="duration"
                                                placeholder="Enter your Tour Plan Duration" aria-label="Duration">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Departure Time</label>
                                        <div class="col-sm-9">
                                            <input type='text' class="form-control form-control-sm" id='datetimepicker'
                                                name="start_time" value='' class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Return Time</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id='datetimepicker1'
                                                name="end_time" value=''
                                                placeholder="Enter your Tour Plan Return Time" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Capacity</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control form-control-sm" name="capacity"
                                                placeholder="Enter your Tour Plan Capacity" aria-label="Capacity">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control form-control-sm" name="price"
                                                placeholder="Enter your Tour Plan Price" aria-label="Price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What Includes Separate multiple by,(comma) or enter key</label>
                                        <input id="tokenfield" type="text" class="form-control form-control-sm"
                                            name="includes" placeholder="Type and hit enter to add a tag">
                                        <!-- <input type="text" class="form-control form-control-sm" placeholder="Includes" aria-label="Includes"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What Excludes Separate multiple by ,(comma) or enter key</label>
                                        <input id="tokenfield_first" type="text" class="form-control form-control-sm"
                                            name="excludes" placeholder="Type and hit enter to add a tag">
                                        <!-- <input type="text" class="form-control form-control-sm" placeholder="Excludes" aria-label="Excludes"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" rows="5" name="des"></textarea>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description">Images</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Plan Gallery<small class="text-danger">*</small></label>
                                        <div class="plans-images"></div>
                                    </div>
                                    <!-- <div class="form-group">
                                            <label>File upload</label>
                                            <input type="file" name="img[]" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control form-control-sm file-upload-info" disabled placeholder="Upload Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tour Plan</h4>
                            <div class="tour-container"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-sm btn-gradient-primary add-tour"><i
                                            class="fa fa-plus"></i> Add Tour</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-sm btn-gradient-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
@stop
@section('pageJsScripts')
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->
    <script type="text/javascript">
        // $('#tokenfield').tokenfield({
        //     autocomplete: {
        //         delay: 100
        //     },
        //     showAutocompleteOnFocus: false
        // });

        // $('#tokenfield_first').tokenfield({
        //     autocomplete: {
        //         delay: 100
        //     },
        //     showAutocompleteOnFocus: false
        // });
    </script>

    <script>
        // ========================================
        // script for Add Tour Plan
        // ========================================
        $('.add-tour').click(function() {
            var html = `<div class="row">
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control form-control-sm" name="tour_title[]" placeholder="Enter your Title Name" aria-label="Title Name" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub Title</label>
                                <input type="text" class="form-control form-control-sm" name="sub_title[]" placeholder="Enter your Sub Title Name" aria-label="Sub title Name" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" rows="5" name="tour_description[]" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12 mb-3 text-right">
                            <button type="button" class="btn btn-sm btn-gradient-danger delete-tour"><i class="fa fa-times"></i> Delete</button>
                        </div>
                    </div>`;
            $('.tour-container').append(html);
        })

        $(document).on('click', '.delete-tour', function() {
            $(this).parent().parent().remove();
        });

        var uRL = $('.demo').val();

        $('#categorySelect').change(function() {
            var category_id = $(this).val();
            if (category_id != '') {
                $('#locationSelect').removeAttr('disabled');
                $.ajax({
                    url: uRL + '/admin/get-locations',
                    type: 'POST',
                    data: {
                        category_id: category_id
                    },
                    success: function(dataResult) {
                        $('#locationSelect').html(dataResult);
                    },
                });
            }
        });
    </script>
@stop
