{!! Form::open(['url'=> Request::path(),'method'=>'GET','class' => 'input-daterange form-inline']) !!}
<div class="form-group mb-2">
    <input type="date" class="form-control" value="{{ !empty(request()->input('start')) ? request()->input('start') : '' }}" name="start" placeholder="from">
</div>
<div class="form-group mx-sm-3 mb-2">
    <input type="date" class="form-control" value="{{ !empty(request()->input('end')) ? request()->input('end') : '' }}" name="end" placeholder="to">
</div>
<div class="form-group mx-sm-3 mb-2">
    {{ Form::select('export', $exports, !empty(request()->input('export')) ? request()->input('export') : null, ['placeholder' => '-- Export ke --', 'class' => 'form-control input-block']) }}
</div>
<div class="form-group mx-sm-3 mb-2">
    <button type="submit" class="btn btn-primary btn-default">Tampil</button>
</div>
{!! Form::close() !!}