@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>Jenis Pengeluaran</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-end">
            {{-- <h4 class="text-center" >Jenis Pengeluaran</h4> --}}
            @if (getRoleName() == 'staff')
              <a href="{{route('expenditure_type.create')}}" class="btn btn-primary">Tambah Jenis Pengeluaran</a>
            @endif
          </div>
            <h4 class="text-center" >Jenis Pengeluaran</h4>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('expenditure_type.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
