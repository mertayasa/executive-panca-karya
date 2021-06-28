@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Data Kunjungan</h4>
            {{-- <a href="{{route('patient.create')}}" class="btn btn-primary">Tambah Registrasi</a> --}}
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::model($visitation, ['route' => ['visitation.update', $visitation->id], 'method' => 'patch']) !!}
            @include('visitation.form')
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{route('visitation.index')}}" class="btn btn-danger">Kembali</a>
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
