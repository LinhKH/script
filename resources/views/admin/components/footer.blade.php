            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">{{site_settings()->footer_copyright}}</span>
                
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- plugins:js -->
    <script src="{{asset('public/assets/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- dateTimepicker -->
    <script src="{{asset('public/assets/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('public/assets/js/iconpicker.js')}}"></script>
    <!-- Tokenfield Js -->
    <script src="{{asset('public/assets/js/tokenfield.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- inject:js -->
    <script src="{{asset('public/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('public/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('public/assets/js/misc.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript" src="jscript/graph.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    <!-- Custom js for this page -->
    <script src="{{asset('public/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('public/assets/js/file-upload.js')}}"></script>
    <!-- End custom js for this page -->
    <!-- jquery-validation -->
    <script src="{{asset('public/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/assets/js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('public/assets/js/image-uploader.js')}}"></script>
    
    <!-- Main_ajax.js -->
    <script src="{{asset('public/assets/js/main_ajax.js')}}"></script>
    
    <input type="hidden" class="demo" value="{{url('/')}}"></input>
    <script>
      $('#target').on('change', function(e) {
        $("#icon").val(e.icon);
      });
      $('#icon').iconpicker({
          
      });
      

      
      jQuery('#datetimepicker').datetimepicker();

      jQuery('#datetimepicker1').datetimepicker();

      $('#tokenfield').tokenfield({
        autocomplete: {
            delay: 100
        },
        showAutocompleteOnFocus: false
      });

      $('#tokenfield_first').tokenfield({
        autocomplete: {
            delay: 100
        },
        showAutocompleteOnFocus: false
      });

      $('.plans-images').imageUploader({
          imagesInputName: 'gallery',
          'label': 'Drag and Drop' 
      });
    </script>
    @yield('pageJsScripts')
  </body>
</html>
                 

















