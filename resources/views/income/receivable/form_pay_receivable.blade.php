@extends('layouts.app')

@section('content')
<section class="section">
    {{-- <div class="section-header">
        <h1>Pendapatan | Piutang</h1>
    </div> --}}
    {{-- <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            
            <a  class="text-danger btn btn-danger" href="javascript:void(0)}" onclick="fullPay('$full_pay ')" > (Belum Berfungsi)  </a>
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
                    {!! Form::model($customer, ['route' => ['income.pay_custom_amount', $customer->id], 'method' => 'patch', 'class' => 'col-12']) !!}
                    <div class="col-12 ">
                        {!! Form::label('incomePay', 'Bayar ', ['class' => 'mb-1']) !!}
                        {!! Form::number('pay', null, ['class' => 'form-control', 'id' => 'incomePay']) !!}
                    </div>
                    <div class="col-12 mt-3">
                      <button class="btn btn-primary mr-3" type="submit">Simpan</button>
                      <a href="{{route('receivable.index')}}" class="btn btn-danger">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
  </section>

  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Daftar Piutang {{ucwords($customer->name)}} </h4>
            
            @if (getRoleName() == 'staff')
              <a  class="text-white btn btn-danger" href="{{route('income.full_pay', $customer->id)}}" > Lunas  </a>
            @endif
          </div>
          <div class="card-body">
            @include('income.receivable.receivable_datatable_detail')
            <a href="{{route('receivable.index')}}" class="btn btn-danger">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Modal -->
  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bayar Piutang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::hidden('income_id', null, ['id' => 'incomeId']) !!}

          {!! Form::label('customerName', 'Pelanggan', []) !!}
          {!! Form::text('customer_name', null, ['class' => 'form-control', 'id' => 'customerName', 'disabled' => true]) !!}

          {!! Form::label('receivableRemain', 'Sisa Piutang', ['class' => 'mt-2']) !!}
          {!! Form::text('receivable_remain', null, ['class' => 'form-control', 'id' => 'receivableRemain', 'disabled' => true]) !!}

          {!! Form::label('payAmount', 'Jumlah Bayar', ['class' => 'mt-2']) !!}
          {!! Form::text('amount', null, ['class' => 'form-control', 'id' => 'payAmount', 'onkeyup' => 'validatePayAmount(this.value)']) !!}
          <span class="text-danger d-none" id="errorPayAmountSpan">Jumlah pembayaran melebihi jumlah piutang yang harus dibayar</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="receivableSubmitBtn" onclick="payReceivable()">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
@endsection

@push('scripts')
  <script>
    let payReceivableUrl

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

    function populateModal(url, customer_name, remaining, income_id){
      payReceivableUrl = url
      const customerName = document.getElementById('customerName').value = customer_name
      const receivableRemain = document.getElementById('receivableRemain').value = remaining
    }

    function validatePayAmount(amount){
      const receivableRemain = document.getElementById('receivableRemain').value
      const errorPayAmountSpan = document.getElementById('errorPayAmountSpan')
      const receivableSubmitBtn = document.getElementById('receivableSubmitBtn')

      if(parseInt(amount) > parseInt(receivableRemain)){
        errorPayAmountSpan.classList.remove('d-none')
        receivableSubmitBtn.setAttribute('disabled', true)
      }else{
        errorPayAmountSpan.classList.add('d-none')
        receivableSubmitBtn.removeAttribute('disabled')
      }

    }

    function payReceivable(){
      const payAmount = document.getElementById('payAmount').value
      const customerName = document.getElementById('customerName').value

      $.ajax({
          url:payReceivableUrl,
          method:'patch',
          data:{
            "_token": "{{ csrf_token() }}",
            "pay": payAmount
          },
          dataType:'json',
          success:function(data){
            if(data.code == 1){
              showToast(data.code, data.message)
            }else{
              showToast(data.code, data.message)
            }

            $('#incomeReceivable').DataTable().ajax.reload()
            $('#exampleModal').modal('hide');
          }
      })

    }
  </script>
@endpush
