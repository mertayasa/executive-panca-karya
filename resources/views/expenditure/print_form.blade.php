@extends('layouts.app')
@section('title', 'Pengeluaran')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pilih Tanggal Data Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        @include('layouts.flash')
                        @include('layouts.error_message')
                        {!! Form::open(['route' => 'expenditure.search_for_print']) !!}
                        <div class="row mt-3">
                            <div class="col-12  pb-3 pb-md-0">
                                {!! Form::label('startDate', 'Tanggal Mulai', ['class' => 'mb-1']) !!}
                                {!! Form::date('start_date', isset($request) ? $request->start_date : null, ['class' => 'form-control', 'id' => 'startDate']) !!}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12  pb-3 pb-md-0">
                                {!! Form::label('endDate', 'Tanggal Selesai', ['class' => 'mb-1']) !!}
                                {!! Form::date('end_date', isset($request) ? $request->end_date : null, ['class' => 'form-control', 'id' => 'endDate']) !!}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="{{ route('expenditure.index') }}" class="btn btn-danger">Kembali</a>
                                <button class="btn btn-primary ml-3" type="submit">Cari Data</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (isset($expenditure_data))
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Data Pengeluaran {{indonesianDate($request->start_date)}} - {{indonesianDate($request->end_date)}}</h4>
                            @if (count($expenditure_data) > 0)
                                <a href="{{route('expenditure.print', [$request->start_date, $request->end_date])}}" class="btn btn-warning"> <i class="fas fa-print"></i> Cetak Pengeluaran</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th>Tanggal Pengeluaran</th>
                                            <th>Jenis Pengeluaran</th>
                                            <th>Total (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1
                                        @endphp
                                        @forelse ($expenditure_data as $expenditure)
                                            <tr>
                                                <td style="text-align: center">{{$no++}}</td>
                                                <td>{{indonesianDate($expenditure->date)}}</td>
                                                <td>{{$expenditure->expenditure_type->name}}</td>
                                                <td>{{$expenditure->amount}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
