@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Pendapatan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
            <button class="btn btn-warning btn-icon icon-left float-right"><i class="fas fa-print"></i> Print Report</button>
        <section class="section mt-lg-5">
          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="kop">
                      <h1>Laporan Pendapatan</h1>
                      <h2>CV. Panca Karya Manunggal</h2>
                      <h3>Jl. Merdeka, Bebalang, Kec. Bangli, Kab. Bangli,Bali</h3>
                      <hr>
                    </div>
                    <hr>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-md">
                        <tr>
                          <th data-width="40">No</th>
                          <th>Tanggal</th>
                          <th class="text-center">Keterangan</th>
                          <th class="text-center">Total</th>
                        </tr>
                         @foreach ($income as $i)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{ $i-> date }}</td>
                          <td class="text-center">{{ $i-> id_types }}</td>
                          <td class="text-center">{{ $i-> total }}</td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                    <hr>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <div class="section-title">Total Pendaapatan</div>
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Subtotal</div>
                          <div class="invoice-detail-value">Rp. 1000</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </section>
      </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
