   
<h1>Selamat Datang</h1>
<a href="pengaduan/create">Ajukan Pengaduan</a>
<!-- jika user login maka hilangkan tombol login dan register, jika user belum login maka hilangkan tombol logout -->
<a href="login">login</a>
<a href="register">register</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input class="dropdown-item" type="submit" value="Logout">
                                </form>

<!-- masukan nik dan email untuk lihat data pengaduanmu -->
 <h2>masukan nik dan email untuk lihat pengaduanmu</h2>
 <form action="" method="get">

   <label for="">nik</label>
   <input type="text"><br>
   <label for="">email</label>
   <input type="email">
   <button type="submit">submit</button>

 </form>