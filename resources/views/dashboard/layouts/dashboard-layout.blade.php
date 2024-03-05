<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Finance</title>
	<meta name="description" content="Finance Company">
	<meta name="keywords" content="accounting, advising, advisory, business, company, consulting, corporate, finance, financial, investments, law, multi-purpose, services, tax help, visual composer">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
    <link href="/admin-assets/assets/css/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin-assets/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin-assets/assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="/admin-assets/assets/css/style.css">
    <link rel="stylesheet" href="/admin-assets/assets/css/candidate-quiz.css">
   
    <link rel="shortcut icon" href="/admin-assets/assets/images/logomini.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('') }}">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="/admin-assets/assets/vendors/js/vendor.bundle.base.js"></script>
</head>

<body>
    
    <div class="container-scroller">

        <x-dashboard-header></x-dashboard-header>
        <div class="container-fluid page-body-wrapper">

            <x-dashboard-sidebar></x-dashboard-sidebar>
            <div class="main-panel">

                @yield('main-section')
    
                <x-dashboard-footer></x-dashboard-footer>

            </div>
        </div>
    </div>

    <script src="/admin-assets/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/admin-assets/assets/js/jquery.cookie.js" type="text/javascript"></script>
    
    <script src="/admin-assets/assets/js/off-canvas.js"></script>
    <script src="/admin-assets/assets/js/hoverable-collapse.js"></script>
    <script src="/admin-assets/assets/js/misc.js"></script>
    <script src="/admin-assets/assets/js/dashboard.js"></script>
    <script src="/admin-assets/assets/js/profile.js"></script>
    <script src="/admin-assets/assets/js/user.js"></script>
    <script src="/admin-assets/assets/js/password.js"></script>
    <script src="/admin-assets/assets/js/register.js"></script>

</body>

</html>