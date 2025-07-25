@extends('layouts.app')

@section('content')
<section class="section">
    {{-- <div class="section-header justify-content-center">
        <h1> Pendapatan</h1>
    </div> --}}
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Detail Pendapatan</h4>
            {{-- <div class="right">
              <button class="btn btn-warning btn-icon icon-left mr-3"><i class="fas fa-print"></i> Cetak Excel</button>
              @if (getRoleName() == 'staff')
                <a href="{{route('income.create')}}" class="btn btn-primary">Tambah Pendapatan</a>
              @endif
            </div> --}}
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
            
            <table class="table">
              <tr>
                <td width="40%"> <b> No Nota  </b></td>
                <td width="60%"><b> {{$income->invoice_no}} </b></td>
              </tr>
              <tr>
                <td width="40%"><b> Nama Pelanggan </b></td>
                <td width="60%"><b> {{$income->customer->name}} </b></td>
              </tr>
              <tr>
                <td width="40%">Status Pembayaran</td>
                <td width="60%">{{$income->status == 0 ? 'Piutang' : 'Lunas'}}</td>
              </tr>
              <tr>
                <td width="40%">Tanggal Pendapatan</td>
                <td width="60%">{{indonesianDateNew($income->date)}}</td>
              </tr>
              <tr>
                <td width="40%">Tanggal Pelunasan</td>
                <td width="60%">{{$income->paid_date != null ? indonesianDateNew($income->paid_date) : '-'}}</td>
              </tr>
              <tr>
                <td width="40%">Jenis Pendapatan</td>
                <td width="60%">{{$income->income_type->name}}</td>
              </tr>
              <tr>
                <td width="40%">Jumlah</td>
                <td width="60%">{{formatPrice($income->total)}}</td>
              </tr>
              <tr>
                <td width="40%">Keterangan</td>
                <td width="60%">{{$income->ket}} </td>
              </tr>
            </table>

            <a href="{{$url_referer}}" class="btn btn-danger">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

