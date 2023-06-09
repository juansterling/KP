@extends('master')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
    {{$errors->first()}}
</div>
@endif
    <h1>Mahasiswa</h1>
    {{Form::open(["url"=>"/add"])}}
    {{Form::text("nrp",null,["placeholder"=>"nrp"])}}
    {{Form::text("nama",null,["placeholder"=>"nama"])}}
    {{Form::select("fkmatkul",$matkul)}}
    {{Form::submit("submit")}}
    {{Form::close()}}

    <table id=table_id class="display">
        <thead>
            <th>NRP</th>
            <th>Nama</th>
            <th>Mata Kuliah</th>
            <th>action</th>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)
                <tr>
                    <td>
                        {{ $item->nrp }}
                    </td>
                    <td>
                        {{ $item->nama }}
                    </td>
                    <td>
                        {{ $item->getMatkul[0]->matkul }}
                    </td>
                    <td>
                        <button class="btn btn-danger"onclick="del('{{ $item->nrp }}')">Delete</button>
                        <a href="/home/edit/{{ $item->nrp }}"><button class="btn btn-warning">Edit</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
        function del(nrp) {
            Swal.fire({
                icon: "warning",
                text: "Delete Data?",
                showCancelButton: true
            }).then((response) => {
                if (response.isConfirmed) {
                    // window.location = '/home/delete/'+nrp
                    $.ajax({
                        url: '/home/delete/' + nrp,
                        type: 'POST',
                        data: {
                            '_method': 'DELETE',
                            '_token': '{{ csrf_token() }}'
                        },
                        success: (response) => {
                            if (response.status == "success") {
                                Swal.fire({
                                    icon: "success",
                                    text: "Deleted"
                                }).then((response)=>{
                                    location.reload();
                                })
                            }else{
                                Swal.fire({
                                    icon: "error",
                                    text: "Error"
                                }).then((response)=>{
                                    location.reload();
                                })
                            }
                        }
                    })
                }
            })
        }
    </script>
@endsection
