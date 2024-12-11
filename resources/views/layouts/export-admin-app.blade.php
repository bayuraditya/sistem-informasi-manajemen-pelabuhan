
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istana Laut</title>
    <link rel="stylesheet" href="{{asset('assets/compiled/css/app.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('assets/compiled/css/app-dark.css')}}"> -->
    <link rel="stylesheet" href="{{asset('assets/compiled/css/iconly.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="{{asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/table-datatable.css')}}"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" /> -->
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css" />
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/table-datatable.css')}}" />
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/app.css')}}" />
    <!-- <link rel="stylesheet" href="{{asset('./assets/compiled/css/app-dark.css')}}" /> -->
 
</head>

<body>    
    
    <script src="assets/static/js/initTheme.js"></script>

      @yield('content')

         

      
    <!-- <script src="{{asset('assets/static/js/components/dark.js')}}"></script> -->
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/dashboard.js')}}"></script>
 

    
<!-- Need: Apexcharts -->
<script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/dashboard.js')}}"></script>
<!-- jQuery (CDN) -->



</body>

</html>