@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pendapatan | Piutang</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Bayar Piutang Sekalian</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            <div class="row ">
                <div class="col-12 col-md-6">
                  <div class="card">
                    <div class="card-body">
                      Sisa Piutang
                      <h3>{{formatPrice($customer->total_receivable)}}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="row">
                    {{-- {!! Form::model($customers, ['route' => ['income.pay_receivable', $customers->id], 'method' => 'patch']) !!} --}}
                    <div class="col-12 ">
                        {!! Form::label('incomePay', 'Bayar ', ['class' => 'mb-1']) !!}
                        {!! Form::number('pay', null, ['class' => 'form-control', 'id' => 'incomePay']) !!}
                    </div>
                    <div class="col-12 mt-3">
                      <button class="btn btn-primary mr-3" type="submit">Simpan</button>
                      <a href="{{route('income.index')}}" class="btn btn-danger">Kembali</a>
                    </div>
                    {{-- {!! Form::close() !!} --}}
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Daftar Piutang {{ucwords($customer->name)}}</h4>
          </div>
          <div class="card-body">
            @include('income.receivable.receivable_datatable_detail')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script>
    function fullPay(url, customerName, remaining){
      Swal.fire({
          title: "Warning",
          // backdrop:false,
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
        toastr.error(`Gagal melunasi ${text}`)
        window.location.reload()
      }
    }
  </script>
@endpush
