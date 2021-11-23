@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>Pelanggan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Data Pelanggan</h4>
            {{-- <a href="{{route('patient.create')}}" class="btn btn-primary">Tambah Registrasi</a> --}}
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {{-- @include('layouts.error_message') --}}
            {!! Form::model($customer, ['route' => ['customer.update', $customer->id], 'method' => 'patch']) !!}
            @include('customer.form')
            <div class="row mt-3">
                <div class="col-12">
                    <button class="btn btn-primary ml-3" type="submit">Simpan</button>
                    <a href="{{route('customer.index')}}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
