@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active') Contact Us @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Contact Us @endslot
@endcomponent
<div id="site-content">
    <div class="container-fluid">
        <div class="row">
            <<div class="offset-3 col-md-6">
                <form class="form-horizontal" id="addContactUs" method="POST">
                    <h3>Get in Touch</h3>
                    @csrf
                    <div class="message"></div>
                    <div class="row mb-1">
                        <label class="col-sm-3 col-form-label">Name: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label class="col-sm-3 col-form-label">Email: </label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label class="col-sm-3 col-form-label">Phone: </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Message:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control h-auto" name="description" id="textarea" rows="4"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')