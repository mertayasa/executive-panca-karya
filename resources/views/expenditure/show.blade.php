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
            <h4>Detail Pengeluaran</h4>
            {{-- <div class="right">
              <button class="btn btn-warning btn-icon icon-left mr-3"><i class="fas fa-print"></i> Print Excel</button>
              @if (getRoleName() == 'staff')
                <a href="{{route('expenditure.create')}}" class="btn btn-primary">Tambah Pendapatan</a>
              @endif
            </div> --}}
          </div>
          <div class="col-12">
       
          <div class="card-body">
            
            <table class="table">
              <tr>
                <td width="40%">Jenis Pengeluaran</td>
                <td width="60%"> {{$expenditure->expenditure_type->name}}</td>
              </tr>
              <tr>
                <td width="40%">Tanggal </td>
                <td width="60%"> {{indonesianDate($expenditure->date)}}</td>
              </tr>
              <tr>
                <td width="40%">Jumlah</td>
                <td width="60%"> {{formatPrice($expenditure->amount)}}</td>
              </tr>
              <tr>
                <td width="40%">Bukti Transaksi</td>
                {{-- <td width="60%">{{$expenditure->note}}</td> --}}
                <td class="pb-2">
                  <img src="{{ asset('images/' . $expenditure->note) }} " class="border my-2" style="object-fit: cover !important; width:200px; height:200px"> 
                  <br>
                  <a href="{{ $note }}" target="_blank">Lihat Bukti Transaksi</a>
                </td>
              </tr>
             
            </table>
            <a href="{{$url_referer}}" class="btn btn-danger">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

