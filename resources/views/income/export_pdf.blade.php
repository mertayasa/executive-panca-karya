<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{asset('admin/css/sb-admin-2.css')}}" rel="stylesheet">
    {{-- <style> 
    .kop {
        text-align: center;
    }
    .title{
        font-size: 20px;

    }
    </style> --}}

    <title>Data Pendapatan {{indonesianDate($start_date)}} -  {{indonesianDate($end_date)}}</title>
</head>
<body>
    <div class="kop">
                      <p class="title"> <b> CV. Panca Karya Manunggal </b></p>
                      <p> Laporan Pendapatan <br>
                      Jl. Merdeka, Bebalang, Kec. Bangli, Kab. Bangli,Bali </p>
                      <hr>
                    </div>
    <div class="container">
        <h3><b>Data Pendapatan Tanggal {{indonesianDate($start_date)}} -  {{indonesianDate($end_date)}} </b></h3>
        <table>
            <thead>
                <tr>
                    <th style="text-align: center">No</th>
                    <th>Invoice</th>
                    <th>Tanggal Pendapatan</th>
                    <th>Tanggal Pelunasan</th>
                    <th>Pelanggan</th>
                    <th>Jenis Pendapatan</th>
                    <th>Keterangan</th>
                    <th>Total (Rp.)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1
                @endphp
                @forelse ($income_data as $income)
                    <tr>
                        <td style="text-align: center">{{$no++}}</td>
                        <td>{{$income->invoice_no}}</td>
                        <td>{{indonesianDate($income->date)}}</td>
                        <td>{{indonesianDate($income->paid_date)}}</td>
                        <td>{{$income->customer->name}}</td>
                        <td>{{$income->income_type->name}}</td>
                        <td>{{$income->ket}}</td>
                        <td>{{$income->total}}</td>
                        {{-- <td>
                            <ol>
                                @foreach ($income->income_log as $log)
                                    <li>
                                        <span class="mb-0"> <b> {{ indonesianDateTime($log->created_at) }} </b> </span>
                                        <br>
                                        <span class="d-inline-block ml-3 {{ $log->income_status == 2 ? 'text-success' : ( $log->income_status == 3 ? 'text-danger' : '') }}"> {{ getincomeStatus($log->income_status, true) }} </span>
                                    </li>
                                @endforeach
                            </ol>
                        </td> --}}
                        {{-- <td>{{getincomeStatus($income->status, true)}}</td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

            <div class="signature text-right"> 
                Bangli,  {{\Carbon\Carbon::now()->isoFormat('LL') }}
                <br><br><br><br><br>
                {{-- @foreach ($transaksi as $data) --}}
                 {{'Pande Nengah Sudirma'}}
                 {{-- @endforeach --}}
            </div>


    </div>

    <style>
        table{
            width: 100%;
            font-style: sans-serif;
            border-collapse: collapse;
        }

        table, th, td{
            border: 1px solid black;
        }

        th, td {
            padding: 3px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .signature{
             margin-left: 55%;
    margin-top: 80px;
    text-align: center;
    color: black;
        }

          .kop {
        text-align: center;
    }
    .title{
        font-size: 20px;
    }
    </style>

    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>