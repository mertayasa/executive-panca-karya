@extends('layouts.app')


@section('content')
<section class="section">
 

    {{-- <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-users-cog"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Staff </h4>
            </div>
            <div class="card-body">
              {{$dashboard_data['staff_count']}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Customer </h4>
            </div>
            <div class="card-body">
              {{$dashboard_data['customer_count']}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-wallet"></i> 
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Pendapatan </h4>
            </div>
            <div class="card-body">
              {{ formatPrice($dashboard_data['income_count']) }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-file-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Piutang </h4>
            </div>
            <div class="card-body">
              {{ formatPrice($dashboard_data['receiavable_count']) }}
            </div>
          </div>
        </div>
      </div>
    </div> --}}


      

{{-- <div class="container bootstrap snippets bootdeys"> --}}
<div class="row pt-5">
    {{-- <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card-d card-just-text" data-background="color" data-color="green" data-radius="none">
                <div class="content">
                    <h6 class="category text-white">Total Staff</h6>
                    <h4 class="title"><a href="#"> *</a></h4>
                    <p class="description"> {{$dashboard_data['staff_count']}} </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card-d card-just-text" data-background="color" data-color="yellow" data-radius="none">
                <div class="content">
                    <h6 class="category text-white">Total Pelanggan</h6>
                    <h4 class="title"><a href="#"> *</a></h4>
                    <p class="description"> {{$dashboard_data['customer_count']}} </p>
                </div>
            </div> 
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 content-card">
        <div class="card-big-shadow">
            <div class="card-d card-just-text" data-background="color" data-color="brown" data-radius="none">
                <div class="content">
                    <h6 class="category text-white">Total Pendapatan</h6>
                    <h4 class="title"><a href="#"> *</a></h4>
                    <p class="description"> {{ formatPrice($dashboard_data['income_count']) }} </p>
                </div>
            </div>
        </div>
    </div> --}}
    
   

    <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img" style="background-color: #343e5f" >
          </div>
          <div class="card-custom-avatar">
           <a href=" {{route('customer.index')}} ">  <span><i class="fa fa-users"></i> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Pelanggan</h5>
              <div class="icon">
                {{$dashboard_data['customer_count']}}
              </div>
          </div>
        </div>
    </div>
    {{-- <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img "  style="background-color:#9a7e83" >
          </div>
          <div class="card-custom-avatar">
            <a href=" {{route('customer.index')}} "> <span><center><i class="fa fa-portrait"></i></center> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Pelanggan</h5>
              <div class="icon">
                {{$dashboard_data['customer_count']}} 
              </div>
          </div>
        </div>
    </div> --}}
    <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img"  style="background-color:#9a7e83" >
          </div>
          <div class="card-custom-avatar">
              <a href=" #income_per_day "> <span><center><i class="fas fa-wallet"></i></center> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Pendapatan</h5>
              <div class="icon">
               {{ formatPrice($dashboard_data['income_count']) }} 
              </div>
          </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img " style="background-color:#acbda6" >
          </div>
          <div class="card-custom-avatar">
           <a href=" #expen_per_day ">  <span><center><i class="fas fa-wallet"></i></center> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Pengeluaran</h5>
              <div class="icon">
                 {{ formatPrice($dashboard_data['receiavable_count']) }}
              </div>
          </div>
        </div>
    </div>
</div>


 @if (getRoleName() == 'staff')  
<div class="row" id="income_per_day">
  <div class="col-12 col-md-12">
    <div class="card-d">
      <div class="card-header">
        <div class="row col-12 align-items-center justify-content-between p-0">
          <div class="col-6">
            <h4>Data Pendapatan Per Hari</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
      {{-- @include('income.filter_datatable', ['tableId' => 'incomeDatatable']) --}}
        <hr>
        @include('dashboard.datatablePerDay')
      </div>
    </div>
  </div>
</div>

<div class="row" id="expen_per_day">
  <div class="col-12 col-md-12">
    <div class="card-d">
      <div class="card-header">
        <div class="row col-12 align-items-center justify-content-between p-0">
          <div class="col-6">
            <h4>Data Pengeluaran Per Hari</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
      {{-- @include('income.filter_datatable', ['tableId' => 'incomeDatatable']) --}}
        <hr>
        @include('dashboard.datatableExPerDay')
      </div>
    </div>
  </div>
</div>
@endif

 @if (getRoleName() == 'owner')
{{--GRAFIK  --}}
    <div class="row">
      <div class="col-6 col-md-6">
        <div class="card-d">
          <div class="card-header">
            <div class="row col-12 align-items-center justify-content-between p-0">
              <div class="col-6">
                <h3>Grafik Pendapatan <span id="incomeSelectedYear">{{\Carbon\Carbon::now()->year}}</span></h3>
              </div>
              <div class="col-6 text-right px-0">
                <div class="card-stats-title">
                  <div class="dropdown d-inline">
                    <a class="font-weight-600 btn btn-new1 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">Pilih Tahun</a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                      @foreach ($dashboard_data['income_years'] as $year)
                        <li><a href="javascript:void(0)" class="dropdown-item" onclick="generateChartData('{{$year}}')">{{$year}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChart" height="350"></canvas>
          </div>
        </div>
      </div>

      <div class="col-6 col-md-6">
        <div class="card-d">
          <div class="card-header">
            <div class="row col-12 align-items-center justify-content-between p-0">
              <div class="col-6">
                <h3>Grafik Pengeluaran <span id="expenditureSelectedYear">{{\Carbon\Carbon::now()->year}}</span></h3>
              </div>
              <div class="col-6 text-right px-0">
                <div class="card-stats-title">
                  <div class="dropdown d-inline">
                    <a class="font-weight-600 btn btn-new1 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">Pilih Tahun</a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                      @foreach ($dashboard_data['expenditure_years'] as $year)
                        <li><a href="javascript:void(0)" class="dropdown-item" onclick="generateChartExpenditureData('{{$year}}')">{{$year}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <canvas id="chartExpenditure" height="350"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class ="row">
    <div class="col-6 col-md-6">
        <div class="card-d">
          <div class="card-header">
            <div class="row col-12 align-items-center justify-content-between p-0">
              <div class="col-6">
                <h3>Grafik persentase  <span id="expenditureSelectedYear">{{\Carbon\Carbon::now()->year}}</span></h3>
              </div>
              <div class="col-6 text-right px-0">
                <div class="card-stats-title">
                  <div class="dropdown d-inline">
                    <a class="font-weight-600 btn btn-new1 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">Pilih Tahun</a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                      @foreach ($dashboard_data['expenditure_years'] as $year)
                        <li><a href="javascript:void(0)" class="dropdown-item" onclick="generateChartExpenditureData('{{$year}}')">{{$year}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <canvas id="chart_pie height="350"></canvas>
          </div>
        </div>
      </div>
    </div>
    </div>
{{-- END GRAFIK --}}
@endif

</section>
@endsection

 @push('scripts')
  <script>
    let chart
    generateChartData()

    function generateChartData(year = null){
      const url = "{{route('dashboard.chart_income')}}"
      let formData = year == null ? {year: 'now'} : {year: year}

      const incomeSelectedYear = document.getElementById('incomeSelectedYear')
      
      if(year != null){
        incomeSelectedYear.innerHTML = year
      }

      $.ajax({
          url: url,
          method: 'POST',
          headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
          data: formData,
          dataType:'json',
          success:function(data){  
              if(data.code === 1){
                if(year != null){
                  chart.destroy()
                  chart = showChart(data)
                }else{
                  chart = showChart(data)
                }
              }

              if(data.code === 0){
                console.log('error')
              }
          }
      })
    }

    function showChart(data){
      let canvasForecast = $('#myChart');
      const labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
      let barChart = new Chart(canvasForecast, {
          type: 'bar',
          data: {
              labels: labels,
              datasets: [
                  {
                      // lineTension: 0,
                      label: 'Pemasukan',
                      borderColor: "#9a7e83",
                      backgroundColor: "#9a7e83",
                      pointHoverBorderColor: "#9a7e83",
                      pointBorderWidth: 0,
                      pointHoverRadius: 10,
                      pointHoverBorderWidth: 1,
                      pointRadius: 3,
                      fill: false,
                      borderWidth: 4,
                      data: data.income
                  },
              ]
          },
          options: {
            responsive:true,
            maintainAspectRatio: false,
            // Can't just just `stacked: true` like the docs say
            scales: {
            yAxes: [{
                // stacked: true,
                ticks: {
                  beginAtZero: true
              }
            }]
            },
            animation: {
                duration: 750,
            },
          }
      });

      return barChart
    }
  </script>

  <script>
    let chartExpenditure
    generateChartExpenditureData()

    function generateChartExpenditureData(year = null){
      const url = "{{route('dashboard.chart_expenditure')}}"
      let formData = year == null ? {year: 'now'} : {year: year}

      const expenditureSelectedYear = document.getElementById('expenditureSelectedYear')
      
      if(year != null){
        expenditureSelectedYear.innerHTML = year
      }

      $.ajax({
          url: url,
          method: 'POST',
          headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
          data: formData,
          dataType:'json',
          success:function(data){  
              if(data.code === 1){
                if(year != null){
                  chartExpenditure.destroy()
                  chartExpenditure = showChartExpenditure(data)
                }else{
                  chartExpenditure = showChartExpenditure(data)
                }
              }

              if(data.code === 0){
                console.log('error')
              }
          }
      })
    }

    function showChartExpenditure(data){
      let canvasExpenditure = $('#chartExpenditure');
      const labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
      let barChartExpenditure = new Chart(canvasExpenditure, {
          type: 'bar',
          data: {
              labels: labels,
              datasets: [
                  {
                      // lineTension: 0,
                      label: 'Pengeluaran',
                      borderColor: "#acbda6",
                      backgroundColor: "#acbda6",
                      pointHoverBorderColor: "#acbda6",
                      pointBorderWidth: 0,
                      pointHoverRadius: 10,
                      pointHoverBorderWidth: 1,
                      pointRadius: 3,
                      fill: false,
                      borderWidth: 4,
                      data: data.expenditure
                  },
              ]
          },
          options: {
            responsive:true,
            maintainAspectRatio: false,
            // Can't just just `stacked: true` like the docs say
            scales: {
            yAxes: [{
                // stacked: true,
                ticks: {
                  beginAtZero: true
              }
            }]
            },
            animation: {
                duration: 750,
            },
          }
      });

      return barChartExpenditure
    }
  </script>

  
@endpush 
