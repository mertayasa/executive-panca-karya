<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Executive Panca Karya</title>

  <!-- Template CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('stisla-assets/css/components.css')}}">
  <link rel="stylesheet" href="{{asset('stisla-assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('stisla-assets/datatables/datatables.css')}}">
  @stack('styles')
  <style>
    .main-content{
      overflow-x: hidden !important;
    }
    
    table, th, td {
        border: 1px solid rgb(189, 189, 189) !important;
        border-collapse: collapse !important;
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <style>
        html.swal2-shown,body.swal2-shown { overflow-y: hidden !important; height: auto!important;}
      </style>

      @include('layouts.navbar')
      
	  <div class="main-sidebar">
		  @include('layouts.sidebar')
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      {{-- <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer> --}}
    </div>
  </div>

  <script src="{{asset('js/app.js')}}" ></script>
  <script src="{{asset('stisla-assets/datatables/datatables.js')}}"></script>
  <script>
    function deleteModel(deleteUrl, tableId){
        Swal.fire({
            title:  "Peringatan",
            text: "Yakin menghapus data ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#169b6b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : deleteUrl,
                    dataType : "Json",
                    data : {"_token": "{{ csrf_token() }}"},
                    method : "delete",
                    success:function(data){
                        console.log(data)
                        if(data.code == 1){
                            Swal.fire(
                                'Berhasil',
                                data.message,
                                'success'
                        )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message
                            })
                        }
                        $('#'+tableId).DataTable().ajax.reload();
                    }
                })
            }
        })
      }

    $(document).ready(function() {
        $('select').select2();
    })
  </script>

  <!-- Page Specific JS File -->
  {{-- <script src="{{asset('admin/js/page/index.js')}}"></script> --}}
  @stack('scripts')

  <style>
    td{
      vertical-align: middle !important;
    }
  </style>
</body>
</html>