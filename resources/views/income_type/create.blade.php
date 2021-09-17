@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>  Jenis Pendapatan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Tambah Jenis Pendapatan</h4>
            {{-- <a href="{{route('patient.create')}}" class="btn btn-primary">Tambah Registrasi</a> --}}
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::open(['route' => 'income_type.store']) !!}
            @include('income_type.form')
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{route('income_type.index')}}" class="btn btn-danger">Kembali</a>
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
