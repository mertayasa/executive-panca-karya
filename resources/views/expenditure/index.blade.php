@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>Pengeluaran</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-end">
            {{-- <h4 class="text-center">Data Pengeluaran</h4> --}}
            <div class="right">
            <a href="{{route('expenditure.print_form')}}" class="btn btn-success"> <i class="fas fa-print"></i> Cetak Pengeluaran</a>
            {{-- @if (getRoleName() == 'staff') --}}
              <a href="{{route('expenditure.create')}}" class="btn btn-primary">Tambah Pengeluaran</a>
            {{-- @endif --}}
            </div>
          </div>
          <h4 class="text-center">Data Pengeluaran</h4>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('expenditure.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
