@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1> Piutang</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-end">
            {{-- <h4 class="text-center">Data Piutang</h4> --}}
            <div class="right">
              <a href="{{route('receivable.print_form_r')}}" class="btn btn-success"> <i class="fas fa-print"></i> Cetak Piutang</a>
              {{-- @if (getRoleName() == 'staff')
                <a href="{{route('receivable.create')}}" class="btn btn-primary">Tambah Piutang</a>
              @endif --}}
            </div>
          </div>
          <h4 class="text-center">Data Piutang</h4>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
            {{-- @include('income.filter_datatable', ['tableId' => 'incomeReceivable'])
            <hr> --}}
            @include('income.receivable.receivable_datatable')
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

    function updateTable(tableid){
      const filterCustomer = document.getElementsByClassName('filter-customer')
      const filterIncomeType = document.getElementsByClassName('filter-income-type')
      const filterMonth = document.getElementsByClassName('filter-month')
      const param = `${filterCustomer[0].value}+${filterIncomeType[0].value}+${filterMonth[0].value}`
      $('#' + tableid).DataTable().ajax.url(url_receivable + `/${param}`).load();    
    }

    function fullPay(url, customerName, remaining){
      Swal.fire({
          title:  "Peringatan",
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
