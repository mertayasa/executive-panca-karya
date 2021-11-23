@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>Pengeluaran</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Data Pengeluaran</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::model($expenditure, ['route' => ['expenditure.update', $expenditure->id], 'method' => 'patch']) !!}
            @include('expenditure.form')
            <br>
            <div class="row ">
              <div class="col-4"></div>
                <div class="col-4 text-center">
                    <a href="{{route('expenditure.index')}}" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary ml-10" type="submit">Simpan</button>
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

