<div class="row mt-3">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
      {!! Form::label('incomeDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'incomeDate', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {{-- {!! Form::label('incomeType', 'Jenis Pendapatan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_income_type', $income_type, null, ['class' => 'form-control', 'id' => 'incomeType', 'disabled' => isset($disabled) ? true : false ]) !!} --}}
          {!! Form::label('incomeStatus', 'Status', ['class' => 'mb-1']) !!}
        {!! Form::select('status', [1 => 'Lunas', 0 => 'Utang'], null, ['class' => 'form-control', 'id' => 'incomeStatus', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
       {!! Form::label('customerId', 'Pelanggan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_customer', $customers, null, ['class' => 'form-control', 'id' => 'customerId', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
           {!! Form::label('incomeTotal', 'Total ', ['class' => 'mb-1']) !!}
        {!! Form::number('total', null, ['class' => 'form-control', 'id' => 'incomeTotal', 'disabled' => isset($disabled) ? true : false]) !!}
    </div>
</div>


<div class="row mt-3">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
    {{-- {!! Form::label('receiverName', 'Nama Penerima ', ['class' => 'mb-1']) !!}
        {!! Form::text('receiver_name', null, ['class' => 'form-control', 'id' => 'receiverName']) !!} --}}
          {!! Form::label('incomeType', 'Jenis Pendapatan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_income_type', $income_type, null, ['class' => 'form-control', 'id' => 'incomeType', 'disabled' => isset($disabled) ? true : false ]) !!}
    </div>
    {{-- <div class="col-12 col-md-6 pb-3 pb-md-0">
      {!! Form::label('incomeTotal', 'Sisa ', ['class' => 'mb-1']) !!}
        {!! Form::number('receivable_remain', null, ['class' => 'form-control', 'id' => 'incomeTotal', 'disabled' => isset($disabled) ? true : false]) !!}
    </div> --}}
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
          {!! Form::label('incomeKet', 'Keterangan ', ['class' => 'mb-1']) !!}
        {!! Form::textarea('ket', null, ['class' => 'form-control', 'id' => 'incomeKet', 'style' => 'height:150px', 'disabled' => isset($disabled) ? true : false]) !!}
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {{-- {!! Form::label('incomeTotal', 'Sisa ', ['class' => 'mb-1']) !!}
        {!! Form::number('receivable_remain', null, ['class' => 'form-control', 'id' => 'incomeTotal', 'disabled' => isset($disabled) ? true : false]) !!} --}}
    </div>
</div>








{{-- <div class="row">
       <div class="col-12  col-md-6 order-md-2">
        {!! Form::label('incomeDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'incomeDate', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
               <div class="col-12  col-md-6 order-md-2">
        {!! Form::label('incomeDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'incomeDate', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
    <div class="col-12 col-md-6 m-auto ">
        {!! Form::label('customerId', 'Pelanggan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_customer', $customers, null, ['class' => 'form-control', 'id' => 'customerId', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
    <div class="col-12 col-md-6 m-auto ">
        {!! Form::label('receiverName', 'Nama Penerima ', ['class' => 'mb-1']) !!}
        {!! Form::text('receiver_name', null, ['class' => 'form-control', 'id' => 'receiverName']) !!}
    </div>
            <div class="col-12  col-md-6 order-md-2">
        {!! Form::label('incomeDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'incomeDate', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
       <div class="col-12  col-md-6 m-auto">
        {!! Form::label('incomeType', 'Jenis Pendapatan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_income_type', $income_type, null, ['class' => 'form-control', 'id' => 'incomeType', 'disabled' => isset($disabled) ? true : false ]) !!}
    </div>
</div>

<div class="row mt-3">
          <div class="col-12  col-md-6 order-md-2">
        {!! Form::label('incomeDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'incomeDate', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
     <div class="col-12 col-md-6 m-auto ">
        {!! Form::label('customerId', 'Pelanggan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_customer', $customers, null, ['class' => 'form-control', 'id' => 'customerId', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
        <div class="col-12 col-md-6 m-auto ">
        {!! Form::label('receiverName', 'Nama Penerima ', ['class' => 'mb-1']) !!}
        {!! Form::text('receiver_name', null, ['class' => 'form-control', 'id' => 'receiverName']) !!}
    </div>
    <div class="col-12  col-md-6 m-auto">
        {!! Form::label('incomeType', 'Jenis Pendapatan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_income_type', $income_type, null, ['class' => 'form-control', 'id' => 'incomeType', 'disabled' => isset($disabled) ? true : false ]) !!}
    </div>
    <div class="col-12  col-md-6 m-auto">
        {!! Form::label('incomeTotal', 'Total ', ['class' => 'mb-1']) !!}
        {!! Form::number('total', null, ['class' => 'form-control', 'id' => 'incomeTotal', 'disabled' => isset($disabled) ? true : false]) !!}
    </div>
    <div class="col-12  col-md-6 m-auto">
        {!! Form::label('incomeType', 'Jenis Pendapatan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_income_type', $income_type, null, ['class' => 'form-control', 'id' => 'incomeType', 'disabled' => isset($disabled) ? true : false ]) !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-12  col-md-6 order-md-2">
        {!! Form::label('incomeStatus', 'Status', ['class' => 'mb-1']) !!}
        {!! Form::select('income_status', [1 => 'Lunas', 0 => 'Utang'], null, ['class' => 'form-control', 'id' => 'incomeStatus', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
     <div class="col-12  col-md-6 order-md-2">
        {!! Form::label('incomeDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'incomeDate', 'disabled' => isset($income) || isset($disabled) ? true : false]) !!}
    </div>
    <div class="col-12  col-md-6 order-md-1">
        {!! Form::label('incomeKet', 'Keterangan ', ['class' => 'mb-1']) !!}
        {!! Form::textarea('ket', null, ['class' => 'form-control', 'id' => 'incomeKet', 'style' => 'height:150px', 'disabled' => isset($disabled) ? true : false]) !!}
    </div>
</div>

<div class="row mt-3">
<div class="col-12  col-md-6 m-auto">
        {!! Form::label('incomeTotal', 'Total ', ['class' => 'mb-1']) !!}
        {!! Form::number('total', null, ['class' => 'form-control', 'id' => 'incomeTotal', 'disabled' => isset($disabled) ? true : false]) !!}
    </div>
   <div class="col-12  col-md-6 m-auto">
        {!! Form::label('incomeTotal', 'Total ', ['class' => 'mb-1']) !!}
        {!! Form::number('total', null, ['class' => 'form-control', 'id' => 'incomeTotal', 'disabled' => isset($disabled) ? true : false]) !!}
    </div> 
</div> --}}

@push('scripts')
    <script>
        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0,10);
        });
        @if(str_contains(Route::currentRouteName(), 'create'))
            const incomeDate = document.getElementById('incomeDate').value = new Date().toDateInputValue()
        @endif
    </script>
@endpush


