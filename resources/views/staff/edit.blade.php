@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1> Staff</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Data Staff </h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::model($staff, ['route' => ['staff.update', $staff->id], 'method' => 'patch']) !!}
            @include('staff.form')
            <br>
            <div class="row">
              <div class="col-12">
                <a href="{{route('staff.index')}}" class="btn btn-danger">Kembali</a>
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
