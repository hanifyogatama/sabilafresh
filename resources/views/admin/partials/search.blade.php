{!! Form::open(['url'=> Request::path(),'method'=>'GET','class' => 'input-daterange form-inline']) !!}
        <input type="text" class="form-control input-block form-control-sm" name="searchInput" value="{{ !empty(request()->input('searchInput')) ? request()->input('searchInput') : '' }}" placeholder="nama / kode">
        <button type="submit" class="ml-2 btn btn-sm btn-primary btn-default px-2"><i class="fas fa-search"></i></button>
{!! Form::close() !!}