@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengeluaran</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Pengeluaran</h4>
            <a href="{{route('expenditure.create')}}" class="btn btn-primary">Tambah Pengeluaran</a>
          </div>
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
