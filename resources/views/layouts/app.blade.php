<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link href="https://image.winudf.com/v2/image1/dXNwLm1sZWFybi51c3Btb2JpbGVhcHBfaWNvbl8xNTU0MjA5MTk0XzAxNg/icon.png?w=170&fakeurl=1" rel="icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-lte/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/summernote/summernote-bs4.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <!-- Bootstrap Switch -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/bootstrap-switch/css/bootstrap2/bootstrap-switch.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/toastr/toastr.min.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     {{-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> --}}
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> --}}

   <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>


    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-teal navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">{{count(Auth::user()->notifications->where('read_at',null))}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{count(Auth::user()->notifications->where('read_at',null))}} Notification(s)</span>
                    <div class="dropdown-divider"></div>
                    @if(count(Auth::user()->notifications->where('read_at',null)) == 0)
                        <a href="#" class="dropdown-item">
                            <span>No new notifications</span>
                        </a>
                        <div class="dropdown-divider"></div>
                    @else
                        @foreach(Auth::user()->notifications->where('read_at',null) as $notification)
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    @endif

                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="https://image.winudf.com/v2/image1/dXNwLm1sZWFybi51c3Btb2JpbGVhcHBfaWNvbl8xNTU0MjA5MTk0XzAxNg/icon.png?w=170&fakeurl=1"
                         class="user-image img-circle" style="height: 20px; width: 20px;" alt="User Image">
                    <span class="d-none d-md-inline ">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="https://image.winudf.com/v2/image1/dXNwLm1sZWFybi51c3Btb2JpbGVhcHBfaWNvbl8xNTU0MjA5MTk0XzAxNg/icon.png?w=170&fakeurl=1"
                             class="img-circle "
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small><span class="badge badge-info">Role: {{Auth::user()->roles->first()->name }}</span></small>

                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-info text-white"
                           onclick="event.preventDefault(); document.getElementById('profile').submit();"
                        ><span class="fas fa-user"></span> Profile</a>
                        <a href="#" class="btn btn-warning btn-flat float-right text-white"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="fas fa-sign-out-alt"></span>
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <form id="profile" action="{{ route('profile') }}" method="GET" class="d-none">
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            @yield('content-header')
        </section>
        <section class="content">
         <div class="container-fluid" data-barba="container">
             @if(session()->has('success'))
		<input type="hidden" value="{{Session::get('success')}}" id="hiddensuccesswcs">
            @endif
            @if(session()->has('error'))
                <input type="hidden" value="{{Session::get('error')}}" id="hiddenerrorwcs">
            @endif
            @if(session()->has('warning'))
                <input type="hidden" value="{{Session::get('warning')}}" id="hiddenwarningwcs">
            @endif
            @yield('content')
            </div>
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        {{-- <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div> --}}
        <strong>Copyright &copy; 2020 <a>Group 9 IEP</a>.</strong> All rights
        reserved.
    </footer>
</div>

<!-- jQuery -->
<script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin-lte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
{{--<script> scr="{{asset('admin-lte/plugins/sweetalert2/sweetalert2.min.js')}}"</script>--}}
{{--<!-- Optional: include a polyfill for ES6 Promises for IE11 -->--}}
{{--<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>--}}
<!-- Bootstrap 4 -->
<script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('admin-lte/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin-lte/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin-lte/plugins/sparklines/sparkline.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin-lte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin-lte/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('admin-lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('admin-lte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->

<script src="{{ asset('admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- Bootstrap Switch -->
<script src="{{ asset('admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<!-- Summernote -->
<script src="{{ asset('admin-lte/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('admin-lte/dist/js/adminlte.js')}}"></script>


{{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>--}}
{{-- <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>--}}
{{-- <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>--}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
{{-- <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>--}}
{{-- --}}{{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script> --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>--}}
{{-- <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap.min.js"></script>--}}


<!-- SweetAlert2 -->
<script src="{{ asset('admin-lte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('admin-lte/plugins/toastr/toastr.min.js')}}"></script>
{{-- <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script> --}}



<script>
    $(document).ready(function(){
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        var start = moment().startOf('hour');
        var end = moment().startOf('hour').add(32, 'hour');
        //Timepicker
        $('#mytimepicker').datetimepicker({
            format: 'LT'
        });
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    });

    $( document ).ready(function() {
       hiddensuccess=$("#hiddensuccesswcs").val();
       swal("Successful", hiddensuccess, "success");
    });
    $( document ).ready(function() {
       hiddenerror=$("#hiddenerrorwcs").val();
       swal("Error Encounted", hiddenerror, "error");
    });
    $(document).ready(function() {
       hiddenwarning=$("#hiddenwarningwcs").val();
       swal("Access Denied", hiddenwarning, "error");
    });
</script>
<script>
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

<script>
    $(function () {
        $(".dataTable1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('.dataTable2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $(".dataTableExport").DataTable({
            dom: 'Bfrtip',
            select: true,
            colReorder: true,
            buttons: [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
                }
            ]
        });
    });
</script>
<script>
    $(function () {
        // Summernote
        $('.textarea').summernote()
    })
</script>




@yield('third_party_scripts')

@stack('page_scripts')
</body>
</html>
