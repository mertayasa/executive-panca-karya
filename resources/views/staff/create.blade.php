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
            <h4>Tambah Staff</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::open(['route' => 'staff.store']) !!}
            @include('staff.form')
            <br>
            <div class="row">
              <div class="col-12">
                <button class="btn btn-primary mr-3" type="submit">Simpan</button>
                <a href="{{route('staff.index')}}" class="btn btn-danger">Kembali</a>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
