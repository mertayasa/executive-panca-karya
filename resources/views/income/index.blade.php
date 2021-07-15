@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pendapatan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Pendapatan</h4>
            <a href="{{route('income.create')}}" class="btn btn-primary">Tambah Pendapatan</a>
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              {{-- @include('income.datatable') --}}
              <div class="bs-example">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#incomeFix" class="nav-link active" data-toggle="tab">Pendapatan Lunas</a>
                    </li>
                    <li class="nav-item">
                        <a href="#incomeNotFix" class="nav-link" data-toggle="tab">Piutang</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="incomeFix">
                        @include('income.datatable')
                    </div>
                    <div class="tab-pane fade" id="incomeNotFix">
                        @include('income.receivable_datatable')
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
          $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
      });
    })

    function fullPay(url, customerName, remaining){
      Swal.fire({
          title: "Warning",
          text: `Yakin melunasi hutang ${customerName} senilai ${remaining} ?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#169b6b',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                url:url,
                method:'patch',
                data:{"_token": "{{ csrf_token() }}"},
                dataType:'json',
                beforeSend:function(){
                    // console.log('begin update')
                },
                success:function(data){
                  if(data.code == 1){
                    showToast(data.code, `Berhasil melunasi hutang ${customerName} senilai ${remaining}`)
                  }else{
                    showToast(data.code, `Gagal melunasi hutang ${customerName} senilai ${remaining}`)
                  }

                  $('#incomeDatatable').DataTable().ajax.reload()
                  $('#incomeReceivable').DataTable().ajax.reload()
                }
            })
          }
        })
    }

    function showToast(code, text){
      if(code = 1){
        toastr.success(`${text}`)
      }

      if(code = 0){
        toastr.error(`Gagal mengubah ${text}`)
        window.location.reload()
      }
    }
  </script>
@endpush
