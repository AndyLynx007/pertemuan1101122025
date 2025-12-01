<!DOCTYPE html>

<html>
<head>
    <title>CRUD Pegawai</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Datatable -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-light">

<div class="container py-4">

    <button class="btn btn-primary mb-3" onclick="$('#formCard').slideToggle()">➕ Tambah Data</button>

    <button class="btn btn-danger mb-3" id="pdf">PDF</button>

    <div class="card mb-4" id="formCard" style="display:none;">
        <div class="card-header bg-dark text-white fw-bold">Form Pegawai</div>

        <form action="/store" method="post" enctype="multipart/form-data" class="p-3">
           @csrf
            <div class="mb-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control">
                        <option>Direktur</option>
                        <option>Manajer</option>
                        <option>Staf</option>
                    </select>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-2">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>

            <div class="mb-2">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <button class="btn btn-success">Simpan</button>
        </form>
    </div>


    <table id="tabel" class="table table-striped table-bordered shadow-sm">
        <thead class="table-dark">
        <tr>
            <th>No</th><th>Nama</th><th>Jabatan</th><th>JK</th><th>Tgl Lahir</th><th>Foto</th><th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            
            @php
             $i = 0;
            @endphp

            @foreach($datanya as $row)
                <?php
                    $i++;
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->jabatan}}</td>
                    <td>{{$row->jenis_kelamin}}</td>
                    <td>{{$row->tanggal_lahir}}</td>
                    <td>
                        @if( $row->foto)
                            <img src="{{ asset('storage/'.$row->foto)}}" width="50">
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm edit"
                            data-id="{{$row->id}}"
                            data-nama="{{$row->nama}}"
                            data-jabatan="{{$row->jabatan}}"
                            data-jk="{{$row->jenis_kelamin}}"
                            data-tgl="{{$row->tanggal_lahir}}"
                        >Edit</button>
                        <button class="btn btn-danger delete-btn btn-sm" data-id="{{$row->id}}">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- modals -->
         <!-- Modal Konfirmasi Delete -->
        <div class="modal fade" id="confirmModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="fs-5 fw-bold text-center text-danger">
                    Apakah Anda yakin ingin menghapus data pegawai ini?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Hapus</a>
                </div>

                </div>
            </div>
        </div>


<script>
    $("#tabel").DataTable();

    $(".edit").click(
        function(){
            $('#formCard').slideDown();
            $('form').attr('action','/update/'+$(this).data('id'));
            $("input[name=nama]").val($(this).data('nama'));
            $("select[name=jabatan]").val($(this).data('jabatan'));
            $("select[name=jenis_kelamin]").val($(this).data('jk'));
            $("input[name=tanggal_lahir]").val($(this).data('tgl'));
        }
    );

    let deleteUrl="";
    $(".delete-btn").click(
        function(){
            let id =$(this).data("id");
            deleteUrl = "/delete/"+id;
            $('#confirmModal').modal("show");
        }    
    );

    $("#confirmDeleteBtn").click(function(){
        window.location.href=deleteUrl;
     }
    );

    $("#pdf").click(function(){
        window.location.href = '/generate_pdf'
    });

</script>

</body>
</html>
