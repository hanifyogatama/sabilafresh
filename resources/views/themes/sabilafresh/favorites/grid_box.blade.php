<div class="col-md-6 col-xl-4">
    <div class="shadow product-wrapper mb-30 rounded-lg">
        <div class="product-img">
            <a href="{{ url('product/'. $product->slug) }}">
                <a href="{{ url('product/'. $product->slug) }}">
                    <img src="{{ $image }}" alt="{{ $product->nama }}"></a>
            </a>
            <span>
                <td class="product-remove">
                    {!! Form::open(['url' => 'favorites/'. $favorite->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    <button style="background-color: transparent; color: black; border: 2px; cursor: pointer;" type="submit"><i class="fa fa-heart fa-2x" style="color: #dc3545 ; margin-top: 8px;"></i></button>
                    {!! Form::close() !!}
                </td>
            </span>

            <div class="card-body pt-1 px-2">
                <div class="card-text">
                    <span style="color: rgba(49, 53, 59, 0.96) !important; text-transform: capitalize;" class="card-title"><a href="{{ url('product/'. $product->slug) }}">{{Str::limit($product->nama,43) }}</a></span>
                </div>

                <div class="badge badge-danger my-0 py-1 mt-2">
                    @foreach ($product->kategories->take(1) as $category)
                    <a style="color: white; font-weight: 500;" href=" {{ url('products/category/'. $category->slug ) }}">{{ $category->nama }}</a></li>
                    @endforeach
                </div>

                <p class="card-text pt-1" style="font-weight:700; color: black; font-size: 14px !important;">Rp {{ number_format($product->price_label()) }}</p>
                <!-- <a type="button"   class="btn btn-outline-danger-fix btn-sm btn-block">Beli</a> -->
            </div>
        </div>
    </div>
</div>