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
            <h4>Tambah Pelanggan</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::open(['route' => 'customer.store']) !!}
            @include('customer.form')
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{route('customer.index')}}" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary ml-3" type="submit">Simpan</button>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
