@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>{{$page_context}}</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Tambah {{$page_context}}</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['route' => Request::is('*income*') ? 'income.store' : 'receivable.store']) !!}
            @include('income.form')
            <br>
            <div class="row">
                <div class="col-12">
                  <a href="{{route('income.index')}}" class="btn btn-danger">Kembali</a>
                  <button class="btn btn-primary mr-3" type="submit">Simpan</button>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
