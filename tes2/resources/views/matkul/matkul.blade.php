@extends('master')
@section('content')
<style>
    #selsemester{
        min-width: 50px !important;
    }
</style>
@if($errors->any())
<div class="alert alert-danger">
    {{$errors->first()}}
</div>
@endif
    <h1>Mata Kuliah</h1>

    {{Form::open(["url"=>"/addmatkul"])}}
    {{Form::text("idmatkul",null,["placeholder"=>"ID Mata Kuliah"])}}
    {{Form::text("matkul",null,["placeholder"=>"Mata Kuliah"])}}
    {{Form::select("sks",["2"=>"2 SKS","3"=>"3 SKS","4"=>"4 SKS"])}}
    {{Form::select("fksemester",$semester,["id"=>"selsemester"])}}
    <div>
        {{Form::submit("Submit")}}
    </div>
    {{Form::close()}}

    <table id=table_id class="display">
        <thead>
            <th>ID Mata Kuliah</th>
            <th>Mata Kuliah</th>
            <th>Total SKS</th>
            <th>Semester</th>
            <th>action</th>


        </thead>
        <tbody>
            @foreach ($matkul as $item)
                <tr>
                    <td>
                        {{ $item->idmatkul }}
                    </td>
                    <td>
                        {{ $item->matkul }}
                    </td>
                    <td>
                        {{ $item->sks }}
                    </td>
                    <td>
                        {{ $item->fksemester }}
                    </td>

                    <td>
                        <button class="btn btn-danger"onclick="del('{{ $item->idmatkul }}')">Delete</button>
                        <a href="/matkul/edit/{{ $item->idmatkul }}"><button class="btn btn-warning">Edit</button></a>
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });

        function del(idmatkul) {
            // if(confirm('delete data?')){
            //     window.location = '/home/delete/'+nrp
            // }
            Swal.fire({
                icon: "warning",
                text: "Delete Data?",
                showCancelButton: true
            }).then((response) => {
                if (response.isConfirmed) {
                    // window.location = '/home/delete/'+nrp
                    $.ajax({
                        url: '/matkul/delete/' + idmatkul,
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
