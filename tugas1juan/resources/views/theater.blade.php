@extends('master')
@section('content')
    <br>
    <br>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <h1>Bioskop</h1>
        <div>
            <button data-bs-target="#tambahbioskop" data-bs-toggle="modal" class="btn btn-outline-success">Tambah</button>
        </div>
    </div>
    <br>


    <table id=table_id class="display">
        <thead>
            <th>#</th>
            <th>Bioskop</th>
            <th>Kota</th>
            <th>Jumlah Studio</th>
            <th>Aksi</th>

        </thead>
        <tbody>
            @foreach ($theaters as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nama_bioskop }}
                    </td>
                    <td>
                        {{ $item->kota }}
                    </td>
                    <td>
                        {{ $item->jumlah_studio }}
                    </td>
                    <td>
                        <button class="btn btn-outline-warning btn-edit" data-th="{{ $item }}"
                            data-bs-target="#updatebioskop" data-bs-toggle="modal">Ubah</button>
                        <button class="btn btn-outline-danger btn-delete" data-id="{{ $item->id }}">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" tabindex="-1" id="tambahbioskop">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bioskop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'POST', 'url' => '/theater']) }}
                    <div class="mb-3">
                        {{ Form::text('nama_bioskop', null, ['class' => 'form-control', 'placeholder' => 'Nama Bioskop', 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('kota', $kotacoll, null, ['class' => 'form-select', 'placeholder' => 'Kota', 'required']) }}
                    </div>
                    <div class="modal-footer">
                        {{ Form::reset('Batal', ['class' => 'btn btn-outline-secondary', 'data-bs-dismiss' => 'modal']) }}
                        {{ Form::submit('Simpan', ['class' => 'btn btn-outline-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="updatebioskop">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bioskop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'PATCH']) }}
                    {{ Form::hidden('id', null, ['id' => 'id']) }}
                    <div class="mb-3">
                        {{ Form::text('edit_nama_bioskop', null, ['class' => 'form-control', 'placeholder' => 'Edit Nama Bioskop', 'required', 'id' => 'nama_bioskop']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('edit_kota', $kotacoll, null, ['class' => 'form-select', 'placeholder' => 'Edit Kota', 'required', 'id' => 'kota']) }}
                    </div>
                    <div class="modal-footer">
                        {{ Form::reset('Batal', ['class' => 'btn btn-outline-secondary', 'data-bs-dismiss' => 'modal']) }}
                        {{ Form::submit('Perbarui', ['class' => 'btn btn-outline-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ Form::open(['method' => 'DELETE', 'id' => 'deleteform']) }}
        {{ Form::hidden('id', null, ['id' => 'deleteid']) }}
        {{ Form::close() }}
    </div>
    <script>
        $('.btn-delete').click(function() {
            Swal.fire({
                icon: "warning",
                text: "Yakin untuk menghapus Bioskop ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'

            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(this).data("id");
                    console.log(id);
                    $("#deleteid").val(id);
                    $('#deleteform').submit();
                }
            })
        })

        function editFunction() {
            const th = $(this).data('th');
            $('#id').val(th.id);
            $('#nama_bioskop').val(th.nama_bioskop)
            $('#kota').val(th.kota)
        }
        $(".btn-edit").click(editFunction);
    </script>
@endsection
