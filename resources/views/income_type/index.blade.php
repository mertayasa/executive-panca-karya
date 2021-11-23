@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>  Jenis Pendapatan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-end">
            {{-- <h4>Data Jenis Pendapatan</h4> --}}
            @if (getRoleName() == 'staff')
              <a href="{{route('income_type.create')}}" class="btn btn-primary">Tambah Jenis Pendapatan</a>
            @endif
          </div>
            <h4 class="text-center" >Jenis Pendapatan</h4>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('income_type.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
