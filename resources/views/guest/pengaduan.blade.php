<!-- mengajukan aduan -->
<h1>input pengaduan</h1>
<form method="post" action="http://localhost/project_tes2/public/pengaduan/store">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">NIK</label>
    <input type="text" class="form-control" name="nik" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">nama</label>
    <input type="text" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">no_hp</label>
    <input type="text" class="form-control" name="no_hp" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">alamat</label>
    <input type="text" class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">judul</label>
    <input type="text" class="form-control" name="judul" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">deskripsi</label>
    <input type="text" class="form-control" name="deskripsi" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
                                    <label for="formFile" class="form-label">file</label>
                                    <input class="form-control" type="file" name="file[]" id="images" accept="image/*" multiple>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">status</label>
    <input type="text" class="form-control" name="status" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div> <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">status_keaktifan</label>
    <input type="text" class="form-control" name="status_keaktifan" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div> <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">respon_admin</label>
    <input type="text" class="form-control" name="respon_admin" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div> <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">respon_pengadu</label>
    <input type="text" class="form-control" name="respon_pengadu" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>