{!! Form::open(['url'=> Request::path(),'method'=>'GET','class' => 'input-daterange form-inline']) !!}
<div class="row mb-4">
    <div class="col-md-3 col-sm-3">
        <input type="text" class="form-control input-block" autocomplete="off" name="searchInput" value="{{ !empty(request()->input('searchInput')) ? request()->input('searchInput') : '' }}" placeholder="kode / nama">
    </div>

    <div class="col-md-3 col-sm-3">
        <div class="input-group input-block">
            <input type="date" class="form-control" value="{{ !empty(request()->input('start')) ? request()->input('start') : '' }}" name="start" placeholder="tanggal awal">
        </div>
    </div>

    <div class="col-md-3 col-sm-3">
        <div class="input-group input-block">
            <input type="date" class="form-control" value="{{ !empty(request()->input('end')) ? request()->input('end') : '' }}" name="end" placeholder="tanggal akhir">
        </div>
    </div>
    <div class="col-md-2 col-sm-2">
        {{ Form::select('status', $statuses, !empty(request()->input('status')) ? request()->input('status') : null, ['placeholder' => 'Semua Status', 'class' => 'form-control input-block']) }}
    </div>
    <div class="col-md-1 col-sm-1">
        <button type="submit" class="btn btn-primary btn-default">Tampil</button>
    </div>
</div>
{!! Form::close() !!}