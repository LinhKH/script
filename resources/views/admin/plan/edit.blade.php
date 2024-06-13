@extends('admin.layout')
@section('title', 'Edit Plan')
@section('content')
    <div class="main-panel">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @component('admin.components.content-header', [
                'breadcrumb' => ['Dashboard' => 'admin/dashboard', 'Plan' => 'admin/plans'],
            ])
                @slot('title')
                    Edit Plan
                @endslot
                @slot('add_btn')
                @endslot
                @slot('active')
                    Edit Plan
                @endslot
            @endcomponent
            <form class="form-sample" id="editPlan" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                @if ($plan)
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Plan Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Plan Name</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" class="url"
                                                    value="{{ url('admin/plans/' . $plan->id) }}">
                                                <input type="text" class="form-control form-control-sm" name="title"
                                                    value="{{ $plan->title }}" placeholder="Enter your Tour Plan"
                                                    aria-label="Tour Plan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Plan Slug</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" name="title_slug"
                                                    value="{{ $plan->title_slug }}"
                                                    placeholder="Enter your Tour Plan Title Slug" aria-label="Tour Plan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm" name="category"
                                                    id="categorySelectEdit" placeholder="Enter your Category Name">
                                                    @if (!empty($category))
                                                        @foreach ($category as $types)
                                                            @if ($plan->category == $types->id)
                                                                <option value="{{ $types->id }}" selected>
                                                                    {{ $types->title }}</option>
                                                            @else
                                                                <option value="{{ $types->id }}">{{ $types->title }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Location</label>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm" name="location"
                                                    id="locationSelectEdit" placeholder="Enter your Location Name">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Duration</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" name="duration"
                                                    value="{{ $plan->duration }}"
                                                    placeholder="Enter your Tour Plan Duration" aria-label="Duration">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Capacity</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control form-control-sm" name="capacity"
                                                    value="{{ $plan->capacity }}"
                                                    placeholder="Enter your Tour Plan Capacity" aria-label="Capacity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Departure Time</label>
                                            <div class="col-sm-9">
                                                <input type='text' class="form-control form-control-sm"
                                                    id='datetimepicker' name="start_time" value="{{ $plan->start_time }}"
                                                    class="form-control form-control-sm" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Return Time</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm"
                                                    id='datetimepicker1' name="end_time" value="{{ $plan->end_time }}"
                                                    placeholder="Enter your Tour Plan Return Time" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Price</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control form-control-sm" name="price"
                                                    value="{{ $plan->price }}" placeholder="Enter your Tour Plan Price"
                                                    aria-label="Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm" name="status"
                                                    placeholder="Enter your Status Name">
                                                    <option value="" selected disabled>Select Status</option>
                                                    <option value="1" {{ $plan->status == '1' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ $plan->status == '0' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>What Includes Separate multiple by,(comma) or enter key</label>
                                            <input id="tokenfield" type="text" class="form-control form-control-sm"
                                                name="includes" value="{{ $plan->includes }}"
                                                placeholder="Type and hit enter to add a tag">
                                            <!-- <input type="text" class="form-control form-control-sm" placeholder="Includes" aria-label="Includes"> -->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>What Excludes Separate multiple by ,(comma) or enter key</label>
                                            <input id="tokenfield_first" type="text"
                                                class="form-control form-control-sm" name="excludes"
                                                value="{{ $plan->excludes }}"
                                                placeholder="Type and hit enter to add a tag">
                                            <!-- <input type="text" class="form-control form-control-sm" placeholder="Excludes" aria-label="Excludes"> -->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea type="text" class="form-control" rows="5" name="des">{!! htmlspecialchars_decode($plan->description) !!}</textarea>
                                        </div>
                                    </div>
                                    <p class="card-description">Images</p>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Plan Gallery<small class="text-danger">*</small></label>
                                            <div class="plans-images1"></div>
                                            <input type="text" hidden name="old_gallery"
                                                value="{{ $plan->gallery }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tour Plan</h4>
                                <div class="tour-container">
                                    @if ($tourPlan->isNotEmpty())
                                        @foreach ($tourPlan as $item)
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="tour_title[]" value="{{ $item->title }}"
                                                            placeholder="Enter your Title Name" aria-label="Title Name"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Sub Title</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="sub_title[]" value="{{ $item->sub_title }}"
                                                            placeholder="Enter your Sub Title Name"
                                                            aria-label="Sub title Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea type="text" class="form-control" rows="5" name="tour_description[]" required>{!! htmlspecialchars_decode($item->description) !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
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
                        <button type="submit" class="btn btn-sm btn-gradient-primary">Update</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
    </div>
    </div>
    @php
        $gallery = array_filter(explode(',', $plan->gallery));
        $gallery_array = [];
        for ($i = 0; $i < count($gallery); $i++) {
            $g = (object) ['id' => $i + 1, 'src' => asset('public/plan/' . $gallery[$i])];
            array_push($gallery_array, $g);
        }
    @endphp
@stop
@section('pageJsScripts')
    <script>
        $(function() {
            var preloaded = <?php echo json_encode($gallery_array); ?>;
            $('.plans-images1').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'gallery1',
                'label': 'Drag and Drop',
                preloadedInputName: 'old',
                maxFiles: 10,
                maxSize: 2 * 1024 * 1024,
            });

            $('#categorySelectEdit').trigger('change');
        });
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

        $('#categorySelectEdit').change(function() {
            var category_id = $(this).val();
            var plan_id = '{{ $plan->id }}';
            if (category_id != '') {
                $.ajax({
                    url: uRL + '/admin/get-locations_edit',
                    type: 'POST',
                    data: {
                        category_id: category_id,
                        plan_id: plan_id
                    },
                    success: function(dataResult) {
                        $('#locationSelectEdit').html(dataResult);
                    },
                });
            }
        });
    </script>
@stop
