
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
    <script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
          <div class="sidebar-header position-relative">
              <div class="d-flex justify-content-between align-items-center">
                  <div class="logo d-inline-flex">
                      <i class="fa-solid fa-location-dot py-auto my-auto px-2" style="color: #fc8d02"></i>
                      <a class="my-auto py-auto px-1" href="/"><h4 class="my-auto py-auto">Istana Laut Serangan</h4></a>
                    </div>
                  
            </div>
          </div>
          <div class="sidebar-menu">
            <ul class="menu">
              <li class="sidebar-title">Menu</li>
              <li class="sidebar-item {{ request()->routeIs('master.index') ? 'active' : '' }} ">
                <a href="{{ route('master.index') }}" class="sidebar-link">
                  <i class="fa-solid fa-house"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item {{ request()->routeIs('master.passenger.index') ? 'active' : '' }} ">
                <a href="{{ route('master.passenger.index') }}" class="sidebar-link">
                  <i class="fa-solid fa-user-group" style="width: 18px;"></i>
                  <span>Passenger</span>
                </a>
              </li>
              <li class="sidebar-item {{ request()->routeIs('master.retribution.index') ? 'active' : '' }} ">
                <a href="{{ route('master.retribution.index') }}" class="sidebar-link">
                  <i class="fa-solid fa-money-bill-wave" style="width: 18px;"></i>
                  <span>Retribusi</span>
                </a>
              </li>
              <li class="sidebar-item {{ request()->routeIs('master.operator.index') ? 'active' : '' }}">
                <a href="{{ route('master.operator.index') }}" class="sidebar-link">
                  <i class="fa-brands fa-ubuntu" style="width: 18px;"></i>
                  <span>Operator</span>
                </a>
              </li>
              <li class="sidebar-item {{ request()->routeIs('master.ship.index') ? 'active' : '' }}">
                <a href="{{ route('master.ship.index') }}" class="sidebar-link">
                  <i class="fa-solid fa-ship" style="width: 18px;"></i>
                  <span>Ship</span>
                </a>
              </li>
              <li class="sidebar-item {{ request()->routeIs('master.route.index') ? 'active' : '' }} ">
                <a href="{{ route('master.route.index') }}" class="sidebar-link">
                  <i class="fa-solid fa-map-location" style="width: 18px;"></i>
                  <span>Rute</span>
                </a>
              </li>
              @if($user->role == 'master')
              <li class="sidebar-item {{ request()->routeIs('master.user.index') ? 'active' : '' }} ">
                <a href="{{ route('master.user.index') }}" class="sidebar-link">
                  <i class="fa-solid fa-users" style="width: 18px;"></i>
                  <span>Users</span>
                </a>
              </li>
              @endif
              <li class="sidebar-item {{ request()->routeIs('master.review.index') ? 'active' : '' }} ">
              <a href="{{ route('master.review.index') }}" class="sidebar-link">
                  <i class="fa-solid fa-star" style="width: 18px;"></i>
                  <span>Reviews</span>
                </a>
              </li>
              <li class="sidebar-item {{ request()->routeIs('master.profile.edit') ? 'active' : '' }} ">
              <a href="{{ route('master.profile.edit') }}" class="sidebar-link">
                  <i class="fa-solid fa-user" style="width: 18px;"></i>
                  <span>Profile</span>
                </a>
              </li>
              
              <li class="sidebar-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class='sidebar-link  bg-transparent border border-0'>
                            <i class="fa-solid fa-right-from-bracket" style="width: 18px;"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                  <a href="index.html" class="sidebar-link">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div id="main">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

    
        <div class="page-content">
            
          <!-- 

            - rata-rata kapal naik per hari
            - rata-rata kapal turun per hari
            - rata-rata penumpang naik per hari
            - rata-rata penumpang turun per hari
            - grafik  lingkaran total kapal turun kapal naik 
            - grafik lingkaran total penumpang naik dan turun
            - chart kapal naik per tanggal dalam 1 bulan
            - chart kapal turun per tanggal dalam 1 bulan
            - chart penumpang naik per tanggal dalam 1 bulan
            - chart penumpang turun per tanggal dalam 1 bulan
            
            -->
            @yield('content')

         
        </div>

        <footer>
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p>2024 © DINAS PERHUBUNGAN KOTA DENPASAR</p>
            </div>
            <div class="float-end">
              <p>
                Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span> by <a href="https://pelabuhanserangan.com">ISTANA LAUT SERANGAN</a>
              </p>
            </div>
          </div>
        </footer>
      </div>
    </div>
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