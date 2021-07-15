@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pendapatan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Tambah Pendapatan</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::open(['route' => 'income.store']) !!}
            @include('income.form')
            <br>
            <div class="row px-0">
                <div class="col-8 m-auto px-0">
                  <button class="btn btn-primary mr-3" type="submit">Simpan</button>
                  <a href="{{route('income.index')}}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
