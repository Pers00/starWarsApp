<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Wars App</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ url('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" />
    
    @yield('css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            @include('admin.welcome.nav')
        </nav>
        <!-- partial -->
        <div class="main-panel" >
          <div class="content-wrapper"  style="padding:0 !important; height:100px!important;">
            <div class="row ">
              <div class="col-12 grid-margin"  >
                <div class="card">
                  <div class="card-body" style="padding:0 !important; height:1000px!important;">
                       @include('admin.welcome.login')
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
       
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ url('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ url('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ url('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ url('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ url('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ url('assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('assets/js/misc.js') }}"></script>
    <script src="{{ url('assets/js/settings.js') }}"></script>
    <script src="{{ url('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
     @yield('js')
    <!-- End custom js for this page -->
  </body>
</html>

