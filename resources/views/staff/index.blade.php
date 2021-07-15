@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Staff</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Staff</h4>
            <a href="{{route('staff.create')}}" class="btn btn-primary">Tambah Staff</a>
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('staff.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
