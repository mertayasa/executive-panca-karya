@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1> Pengeluaran</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Tambah Pengeluaran</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::open(['route' => 'expenditure.store']) !!}
            @include('expenditure.form')
            <br>
            <div class="row ">
              <div class="col-4"></div>
                <div class="col-4 text-center">
                   <button class="btn btn-primary ml-10" type="submit">Simpan</button>
                    <a href="{{route('expenditure.index')}}" class="btn btn-danger">Kembali</a>
                </div>
                <div class="col-4"></div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
