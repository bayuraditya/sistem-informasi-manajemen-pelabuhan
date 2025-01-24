ini index admin
<form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input class="dropdown-item" type="submit" value="Logout">
</form>
{{ $user->name }}
<h1>data pengaduan</h1>
<table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No Pengaduan</td>
                            <td>nik</td>
                            <td>nama</td>
                            <td>no hp</td>
                            <td>email</td>
                            <td>alamat</td>
                            <td>judul</td>
                            <td>deskripsi</td>
                            <td>file</td>
                            <td>status</td>
                            <td>status_keaktifan</td>
                            <td>respon_admin</td>
                            <td>respon_pengadu</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pengaduan as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->nik }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->no_hp }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->judul }}</td>
                                <td>{{ $p->deskripsi }}</td>
                                <td>{{ $p->file }}</td>
                                <td>{{ $p->status }}</td>
                                <td>{{ $p->status_keaktifan }}</td>
                                <td>{{ $p->respon_admin }}</td>
                                <td>{{ $p->respon_pengaduan }}</td>
                                <td>
                                    <a href="/admin/pengaduan/{{ $p->id }}" type="submit"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pengaduan.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                            onclick="return confirm('Are you sure you want delete {{ $p->judul }} ?')"
                                            type="submit" class="btn btn-danger" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                                
                        