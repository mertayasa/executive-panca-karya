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
            <h4>Bayar Piutang</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::model($income, ['route' => ['income.pay_receivable', $income->id], 'method' => 'patch']) !!}
            <div class="row ">
                <div class="col-12 col-md-6">
                  <div class="card">
                    <div class="card-body">
                      Sisa Piutang
                      <h3>{{formatPrice($income->receivable_remain)}}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="row">
                    <div class="col-12 ">
                        {!! Form::label('incomePay', 'Bayar ', ['class' => 'mb-1']) !!}
                        {!! Form::number('pay', null, ['class' => 'form-control', 'id' => 'incomePay']) !!}
                    </div>
                    <div class="col-12 mt-3">
                      <button class="btn btn-primary mr-3" type="submit">Simpan</button>
                      <a href="{{route('income.index')}}" class="btn btn-danger">Kembali</a>
                    </div>
                  </div>
                </div>
            </div>
            <hr>
            <br>
            <h5>Detail Pendapatan</h5>
            @include('income.form', ['disabled' => true])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
