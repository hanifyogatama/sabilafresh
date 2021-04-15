<p class="text-primary mt-4">Product Variants</p>
<hr />
@foreach ($product->variants as $variant)
{!! Form::hidden('variants['. $variant->id .'][id]', $variant->id) !!}
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('sku', 'SKU') !!}
            {!! Form::text('variants['. $variant->id .'][sku]', $variant->sku, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('nama', 'Nama') !!}
            {!! Form::text('variants['. $variant->id .'][nama]', $variant->nama, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('harga', 'Harga') !!}
            {!! Form::text('variants['. $variant->id .'][harga]', $variant->harga, ['class' => 'form-control', 'required' => true]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('qty', 'Stock') !!}
            {!! Form::text('variants['. $variant->id .'][qty]', ($variant->productInventory) ? $variant->productInventory->qty : null, ['class' => 'form-control', 'required' => true]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('berat', 'Berat Satuan') !!}
            {!! Form::text('variants['. $variant->id .'][berat]', $variant->berat, ['class' => 'form-control', 'required' => true]) !!}
        </div>
    </div>
</div>
@endforeach
<hr />