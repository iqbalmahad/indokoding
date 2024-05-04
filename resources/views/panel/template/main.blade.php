<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ url('favicon.svg') }}" type="image/x-icon">
    <title>Hi Koding | Panel</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link href="{{ url('dist/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('dist/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link href="{{ url('dist/css/mystyle.css') }}" rel="stylesheet">

</head>
<body id="page-top">

    <div id="wrapper">
        @include('panel.template.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('panel.template.navbar')
                @yield('content')
            </div>
            @include('panel.template.footer')
        </div>
    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        // Script untuk menghilangkan notifikasi setelah beberapa detik dengan animasi fade
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.remove();
                }, 500); // Waktu animasi fade (500 milidetik)
            });
        }, 4000); // Notifikasi akan dihapus setelah 2 detik (2000 milidetik)
    </script>
    

    {{-- <script src="{{ url('dist/vendor/jquery/jquery.min.js') }}"></script>
    --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="{{ url('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{ url('dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{ url('dist/js/sb-admin-2.min.js') }}"></script>
    
    <!-- Page level plugins -->
    <script src="{{ url('dist/vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- Page level custom scripts -->
    <script src="{{ url('dist/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ url('dist/js/demo/chart-pie-demo.js') }}"></script>
    
    
</body>
</html>