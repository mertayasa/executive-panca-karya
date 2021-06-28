@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pelanggan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Pelanggan</h4>
            <a href="{{route('customer.create')}}" class="btn btn-primary">Tambah Pelanggan</a>
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('customer.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
