@extends('layouts.admin-app')
@section('content')

<div class="page-heading">
    <h3>Ubah Password</h3>
</div>
                <div class="card">
                    

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="/master/profile/change-password/{{$user->id}}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="current_password">Kata Sandi Lama</label>
        <input id="current_password" type="password" class="form-control" name="current_password" required>
        <input type="checkbox" onclick="togglePasswordVisibility('current_password')"> Lihat Password
    </div>

    <div class="form-group">
        <label for="new_password">Kata Sandi Baru</label>
        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
        <input type="checkbox" onclick="togglePasswordVisibility('new_password')"> Lihat Password
        @error('new_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="new_password_confirmation">Konfirmasi Kata Sandi Baru</label>
        <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required autocomplete="new-password">
        <input id="new_password_confirmation" type="checkbox" onclick="togglePasswordVisibility('new_password_confirmation')"> 
    Lihat Password
    </div>

    <br>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

                    </div>
                </div>
            </div>
        </div>
        <script>
    function togglePasswordVisibility(fieldId) {
        var passwordField = document.getElementById(fieldId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

  

@endsection
