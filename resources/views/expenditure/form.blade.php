<div class="row">
    <div class="col-2"></div>
     <div class="col-12 col-md-8">
        {!! Form::label('expenseDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'expenseDate']) !!}
    </div>
     <div class="col-2"></div>
</div>
<div class="row mt-3">
    <div class="col-2"></div>
    <div class="col-12  col-md-8">
        {!! Form::label('expenseType', 'Jenis Pengeluaran ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_types', $expenditure_type, null, ['class' => 'form-control', 'id' => 'expanseType']) !!}
    </div>
     <div class="col-2"></div>
</div>
<div class="row mt-3">
    <div class="col-2"></div>
    <div class="col-12  col-md-8">
        {!! Form::label('expenseAmount', 'Jumlah Pengeluaran ', ['class' => 'mb-1']) !!}
        {!! Form::number('amount', null, ['class' => 'form-control', 'id' => 'expenseAmount']) !!}
    </div>
     <div class="col-2"></div>
</div>
<div class="row mt-3">
    <div class="col-2"></div>
    <div class="col-12  col-md-8">
        {!! Form::label('expenseNote', 'Nota', ['class' => 'mb-1']) !!}
        {!! Form::file('note', ['class' => 'd-block filepond', 'id' => 'expenseNote']) !!}
    </div>
     <div class="col-2"></div>
</div>

@push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                FilePond.registerPlugin(
                    FilePondPluginFileEncode,
                    FilePondPluginFileValidateSize,
                    FilePondPluginFileValidateType,
                    FilePondPluginImageExifOrientation,
                    FilePondPluginImagePreview
                );

                let options
                let imageUrl
                const url = window.location

                @if(Request::is('*/create'))
                    options = {
                        acceptedFileTypes: ['image/png', 'image/jng', 'image/jpeg'],
                        maxFileSize: '500KB'
                    }
                @else
                    imageUrl = "{{asset('images/'.$expenditure->note)}}"
                    options = {
                        acceptedFileTypes: ['image/png', 'image/jng', 'image/jpeg'],
                        maxFileSize: '500KB',
                        files: [{
                            source: imageUrl,
                            options:{
                                    type: 'remote'
                            }
                        }],
                    }
                @endif

                if(url.pathname.includes('tambah')){

                }else{

                }

                FilePond.create(
                    document.getElementById('expenseNote'), options
                );
            })
        </script>
    @endpush
