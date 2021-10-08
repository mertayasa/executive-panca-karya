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
              <button class="btn btn-warning btn-icon icon-left mr-3"><i class="fas fa-print"></i> Print Excel</button>
              @if (getRoleName() == 'staff')
                <a href="{{route('income.create')}}" class="btn btn-primary">Tambah Pendapatan</a>
              @endif
            </div> --}}
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
            
            <table class="table table-bordered table-responsive">
              <tr>
                <td style="width: 300px">Tanggal Pelunasan</td>
                <td>{{indonesianDateNew($income->updated_at)}}</td>
              </tr>
              <tr>
                <td>Jumlah</td>
                <td>{{formatPriceRaw($income->total)}}</td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>{{$income->ket}} </td>
              </tr>
            </table>

            <a href="{{$url_referer}}" class="btn btn-danger">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

