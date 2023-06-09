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
        <h1>Studio</h1>
        <div>
            <button data-bs-target="#tambahstudio" data-bs-toggle="modal" class="btn btn-outline-success">Tambah</button>
        </div>
    </div>
    <br>
    {{ Form::open(['method' => 'GET',"id"=>"filterform"]) }}
    <div class="mb-3 d-flex gap-3">
        {{ Form::select('theater', $theatercoll,$selected, ['class' => 'form-select',"placeholder"=>"Filter Theater","id"=>"filter"]) }}
    </div>
    {{ Form::close() }}

    <table id=table_id class="display">
        <thead>
            <th>#</th>
            <th>Theater</th>
            <th>Studio</th>
            <th>Jenis Studio</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($studios as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->studio_theater->nama_bioskop}} - {{$item->studio_theater->kota}}
                    </td>
                    <td>
                        {{ $item->studio }}
                    </td>
                    <td>
                        {{ $item->jenis_studio }}
                    </td>
                    <td>
                        <button class="btn btn-outline-warning btn-edit" data-s="{{ $item }}"
                            data-bs-target="#updatestudio" data-bs-toggle="modal">Ubah</button>
                        <button class="btn btn-outline-danger btn-delete" data-id="{{ $item->id }}">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" tabindex="-1" id="tambahstudio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Studio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'POST', 'url' => '/studio']) }}
                    <div class="mb-3">
                        {{ Form::select('Bioskop', $theatercoll,null, ['class' => 'form-select',"placeholder"=>"Pilih Bioskop","required"]) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('Jenis_Studio', $jeniscoll, null, ['class' => 'form-select', 'placeholder' => 'Pilih Jenis Studio', 'required']) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::number('Studio', null, ['class' => 'form-control', 'placeholder' => 'Studio', 'required']) }}
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
    <div class="modal fade" tabindex="-1" id="updatestudio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Studio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'PATCH']) }}
                    {{ Form::hidden('id', null, ['id' => 'id']) }}
                    <div class="mb-3">
                        {{ Form::select('Edit_Bioskop', $theatercoll,null, ['class' => 'form-select',"placeholder"=>"Pilih Bioskop","required","id"=>"nama_bioskop"]) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::select('Edit_Jenis_Studio', $jeniscoll, null, ['class' => 'form-select', 'placeholder' => 'Pilih Jenis Studio', 'required',"id"=>"jenis_studio"]) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::number('Edit_Studio', null, ['class' => 'form-control', 'placeholder' => 'Studio', 'required',"id"=>"studio"]) }}
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
        $(document).ready(function() {
            $('#filter').select2();
        });
        $('.btn-delete').click(function() {
            Swal.fire({
                icon: "warning",
                text: "Yakin untuk menghapus Studio ini?",
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
            const s = $(this).data('s');
            $('#id').val(s.id);
            $('#nama_bioskop').val(s.theater_id);
            $('#jenis_studio').val(s.jenis_studio)
            $('#studio').val(s.studio)
        })
        $("#filter").change(function(){
            $("#filterform").submit();
        });
    </script>
@endsection
