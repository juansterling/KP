@extends('dashboard.base')

@section('css')
    {{-- Datatables --}}
    <meta name="csrf-token" content="{!! csrf_token() !!}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <style>
        .dataTables_wrapper select {
            min-width: 50px !important;
        }

        #program {
            width: 200px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="mt-1">Prasyarat Program Penelitian: {{ $schemes->research_scheme }}</h4>
                <div>
                    <a href="/master/skema-penelitian/{{ $schemes->id }}/requirement"><button class="btn btn-outline-info"
                            data-target="#kembali" data-toggle="modal">Kembali</button></a>
                    <button class="btn btn-outline-success" data-target="#tambahsp" data-toggle="modal">Tambah</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="spTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Program Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reqprograms as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> {{ $item->programme_name }}</td>
                            <td>
                                <button class="btn btn-outline-danger btn-delete"
                                    data-dt="{{ $item }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" tabindex="-1" id="tambahsp">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Prasyarat Program Penelitian</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(['method' => 'POST', 'url' => '/master/skema-penelitian/' . $schemes->id . '/requirement/program']) }}
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        {{ Form::label('namaprogram[]', 'Nama Program', ['class' => 'form-label']) }}
                                    </div>
                                    <div class="col">
                                        {{ Form::select('namaprogram[]', $programcoll, null, ['id' => 'program', 'multiple' => 'multiple']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{ Form::reset('Batal', ['class' => 'btn btn-outline-secondary', 'data-dismiss' => 'modal']) }}
                                {{ Form::submit('Simpan', ['class' => 'btn btn-outline-primary']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ Form::open(['method' => 'DELETE', 'id' => 'deleteform']) }}
        {{ Form::hidden('id', null, ['id' => 'deleteid']) }}
        {{ Form::close() }}
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#spTable').DataTable();
            $('#program').select2();
        });

        $('.btn-delete').click(function() {
            var dt = $(this).data('dt');
            Swal.fire({
                title: "Yakin mau menghapus Program Mahasiswa ini?",
                icon: "warning",
                confirmButtonText: "Hapus",
                cancelButtonText: "Kembali",
                confirmButtonColor: "#d9534f",
                showCancelButton: true,
                allowOutsideClick: false
            }).then((response) => {
                if (response.isConfirmed) {
                    $('#deleteid').val(dt.id);
                    $('#deleteform').submit();
                }
            });
        });
    </script>
@endsection
