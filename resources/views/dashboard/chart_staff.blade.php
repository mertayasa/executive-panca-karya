<div class="row" id="income_per_day">
    <div class="col-6 col-md-6">
      <div class="card-d">
        <div class="card-header">
          <div class="row col-12 align-items-center justify-content-between p-0">
            <div class="col-12">
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
 
  
  {{-- <div  id="expen_per_day"> --}}
    <div class="col-6 col-md-6" id="expen_per_day" >
      <div class="card-d">
        <div class="card-header">
          <div class="row col-12 align-items-center justify-content-between p-0">
            <div class="col-12">
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