@extends('master')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
    {{$errors->first()}}
</div>
@endif
    <h1>Semester</h1>

    {{Form::open(["url"=>"/addsemester"])}}
    {{Form::text("idsemester",null,["placeholder"=>"ID Semester"])}}
    {{Form::text("semester",null,["placeholder"=>"Semester"])}}
    {{Form::submit("Submit")}}
    {{Form::close()}}

    <table id=table_id class="display">
        <thead>
            <th>ID</th>
            <th>Semester</th>
            <th>action</th>
        </thead>
        <tbody>
            @foreach ($semester as $item)
                <tr>
                    <td>
                        {{ $item->idsemester }}
                    </td>
                    <td>
                        {{ $item->semester }}
                    </td>

                    <td>
                        <button class="btn btn-danger"onclick="del('{{ $item->idsemester }}')">Delete</button>
                        <a href="/semester/edit/{{ $item->idsemester }}"><button class="btn btn-warning">Edit</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });

        function del(idsemester) {
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
                        url: '/semester/delete/' + idsemester,
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
