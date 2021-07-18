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
            <h4>Edit Data Pendapatan</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {{-- @include('layouts.error_message') --}}
            {!! Form::model($income, ['route' => ['income.update', $income->id], 'method' => 'patch']) !!}
            @include('income.form')
            <div class="row px-0 mt-3">
                <div class="col-12 ">
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
