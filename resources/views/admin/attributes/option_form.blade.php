<div class="card card-default">
    <div class="card-header">
        <h5>Tambah</h5>
    </div>
    <div class="card-body">
        @include('admin.partials.flash', ['$errors' => $errors])
        @if (!empty($attributeOption))
        {!! Form::model($attributeOption, ['url' => ['admin/attributes/options', $attributeOption->id], 'method' => 'PUT']) !!}
        {!! Form::hidden('id') !!}
        @else
        {!! Form::open(['url' => ['admin/attributes/options', $attribute->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @endif
        {!! Form::hidden('atribut_id', $attribute->id) !!}
        <div class="form-group">
            {!! Form::label('nama', 'Nama') !!}
            {!! Form::text('nama', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-footer pt-5 border-top">
            <button type="submit" class="btn btn-primary btn-default">Simpan</button>
            <a href="{{ url('admin/attributes/') }}" class="btn btn-secondary btn-default">Kembali</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>