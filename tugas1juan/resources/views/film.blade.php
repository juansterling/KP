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
        <h1>Film</h1>
        <div>
            <button data-bs-target="#tambahfilm" data-bs-toggle="modal" class="btn btn-outline-success">Tambah</button>
        </div>
    </div>
    <br>

    <table id=table_id class="display">
        <thead>
            <th>#</th>
            <th>Judul</th>
            <th>Durasi</th>
            <th>Rating</th>
            <th>Sinopsis</th>
            <th>Rilis</th>
            <th>Bahasa</th>
            <th>Aksi</th>

        </thead>
        <tbody>
            @foreach ($films as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->film }}
                    </td>
                    <td>
                        {{ $item->durasi }} menit
                    </td>
                    <td>
                        {{ $item->rating }}
                    </td>
                    <td>
                        @if ($item->sinopsis != null)
                            {{ $item->sinopsis }}
                        @else
                            -
                        @endif

                    </td>
                    <td>
                        {{ $item->film_filmdetail->jadwal_rilis }}
                    </td>
                    <td>
                        {{ $item->film_filmdetail->bahasa }}
                    </td>
                    <td>
                        <button class="btn btn-outline-warning btn-edit" data-f="{{ $item }}"
                            data-fd="{{ $item->film_filmdetail }}" data-bs-target="#updatefilm"
                            data-bs-toggle="modal">Edit</button>
                        <button class="btn btn-outline-danger btn-delete" data-id="{{ $item->id }}">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" tabindex="-1" id="tambahfilm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Film</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'POST', 'url' => '/film']) }}
                    <div class="mb-3">
                        {{ Form::text('judul_film', null, ['class' => 'form-control', 'placeholder' => 'Judul Film', 'required', 'unique']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::number('durasi', null, ['class' => 'form-control', 'placeholder' => 'Durasi', 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('rating', $ratingcoll, null, ['class' => 'form-select', 'placeholder' => 'Rating', 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::textarea('sinopsis', null, ['class' => 'form-control', 'placeholder' => 'Sinopsis']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::date('jadwal_rilis', null, ['class' => 'form-control', 'placeholder' => 'Jadwal Rilis', 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('bahasa', $bahasacoll, null, ['class' => 'form-select', 'placeholder' => 'Bahasa', 'required']) }}
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
    <div class="modal fade" tabindex="-1" id="updatefilm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Film</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'PATCH']) }}
                    {{ Form::hidden('id', null, ['id' => 'id']) }}
                    <div class="mb-3">
                        {{ Form::text('edit_judul_film', null, ['class' => 'form-control', 'placeholder' => 'Edit Judul Film', 'required', 'unique', 'id' => 'film']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::number('edit_durasi', null, ['class' => 'form-control', 'placeholder' => 'Edit Durasi', 'required', 'id' => 'durasi']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('edit_rating', $ratingcoll, null, ['class' => 'form-select', 'placeholder' => 'Edit Rating', 'required', 'id' => 'rating']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::textarea('edit_sinopsis', null, ['class' => 'form-control', 'placeholder' => 'Edit Sinopsis', 'id' => 'sinopsis']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::date('edit_jadwal_rilis', null, ['class' => 'form-control', 'placeholder' => 'Edit Jadwal Rilis', 'required', 'id' => 'jadwal_rilis']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('edit_bahasa', $bahasacoll, null, ['class' => 'form-select', 'placeholder' => 'Pilih Bahasa', 'required', 'id' => 'bahasa']) }}
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
                text: "Yakin untuk menghapus Film ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(this).data("id");
                    $("#deleteid").val(id);
                    $('#deleteform').submit();
                }
            })
        })
        $('.btn-edit').click(function() {
            const f = $(this).data('f');
            const fd = $(this).data('fd');
            $('#id').val(f.id);
            $('#film').val(f.film)
            $('#durasi').val(f.durasi)
            $('#rating').val(f.rating)
            $('#sinopsis').val(f.sinopsis)
            $('#jadwal_rilis').val(fd.jadwal_rilis)
            $('#bahasa').val(fd.bahasa)
        })
    </script>
@endsection
