@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1> Staff</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-end ">
              {{-- <h4>Data Staff</h4> --}}
            <a href="{{route('staff.create')}}" class="btn btn-primary mb-5">Tambah Staff</a>
          </div>
          <h4 class="text-center" >Data Staff</h4>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body pt-0">
              @include('staff.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
