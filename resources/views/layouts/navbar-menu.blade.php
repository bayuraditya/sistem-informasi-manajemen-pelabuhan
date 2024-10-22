    <style>
        /* Navbar awal (transparan dengan teks putih) */
        .navbar-custom {
            background-color: white;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Teks putih saat navbar transparan */
        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: dark !important;
            transition: color 0.3s ease;
        }

        /* Teks hitam dan background putih saat discroll */
        .navbar.scrolled {
            background-color: white !important;
            box-shadow: 0 4px 2px -2px rgba(0,0,0,.1);
        }

        /* Teks hitam saat navbar berubah solid */
        .navbar.scrolled .nav-link,
        .navbar.scrolled .navbar-brand {
            color: black !important;
        }

        /* Menambahkan jarak antar menu */
        .navbar-nav .nav-item {
            margin-right: 20px; /* Sesuaikan jarak sesuai kebutuhan */
        }

        /* Optional: Menambahkan padding pada item terakhir */
        .navbar-nav .nav-item:last-child {
            margin-right: 0;
        }
    </style>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-light navbar-custom">
  <div class="container-fluid">

    <a class="navbar-brand" href="/">
  <i class="fa-solid fa-location-dot py-auto my-auto px-2" style="color: #fc8d02; font-size: 30px;"></i>
  Istana Laut</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#aboutUs">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/boats">Boats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/operators">Operators</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/reviews">Reviews</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/#contactUs">Contact Us</a>
        </li>
        @if (auth()->user())
        <li class="nav-item">
          <a class="nav-link" href="/master">Dashboard</a>
        </li>
        @else
        <li class="nav-item ">
          <a class="nav-link" href="/login">Login</a>
        </li>
        @endif

        
      </ul>
    </div>
  </div>
</nav>


<!-- JavaScript untuk efek scroll -->
<script>
    // Mengubah gaya navbar dan warna teks saat di-scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

