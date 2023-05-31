<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>
    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top bg-dark " data-bs-theme="dark">
        <div class="container-fluid">

          <a class="navbar-brand" href="/home">I2C</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/semester">Semester</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/matkul">Mata Kuliah</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>

            </ul>

          </div>
        </div>
      </nav>


    <div class="container">
        @yield('content')
    </div>


    <script>
        $(document).ready(function() {
            const setting = document.cookie.split(";")[0];
            console.log(setting);
            if(setting == "theme=dark"){
                $("html").attr("data-bs-theme","dark");
                $("#theme").prop("checked",true);
                $("nav").attr("class","navbar navbar-expand-lg bg-dark")

            }else{
                $("html").attr("data-bs-theme","light");
                $("nav").attr("class","navbar navbar-expand-lg bg-primary")
            }
            $('#table_id').DataTable();
            $('select').select2();
            $('#theme').click(function(){
               const theme=$(this).prop("checked");
               if(theme){
                   $("html").attr("data-bs-theme","dark");
                   document.cookie="theme=dark";
               }else{
                $("html").attr("data-bs-theme","light");
                document.cookie="theme=light";
               }

               location.reload();

            });
        });

    </script>
</body>

</html>
