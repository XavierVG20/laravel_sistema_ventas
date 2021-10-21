<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@section('htmlheader')
@include('partials.htmlheader')
@show

<body class="hold-transition skin-blue sidebar-mini">
    <div id="app" class="wrapper">
        @include('partials.mainheader')
        @include('partials.controlsidebar')


        <div class="content-wrapper">

            <main class="py-4">
                @yield('content')
            </main>

        </div>

        @include('partials.control-sidebar')
 <!-- Main Footer -->
 <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      0.01v
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="#">VGStudio</a>.</strong> 
  </footer>

    </div>


</body>


<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- ChartJS 1.0.1 -->
<script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
</body>

</html>