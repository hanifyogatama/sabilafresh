<div class="col-md-6 col-xl-4">
    <div class="shadow product-wrapper mb-30 rounded-lg">
        <div class="product-img">
            <a href="{{ url('product/'. $product->slug) }}">
                <a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}"></a>
            </a>
            <span>
                <td class="product-remove">
                    {!! Form::open(['url' => 'favorites/'. $favorite->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    <button style="background-color: transparent; color: black; border: 2px; cursor: pointer;" type="submit"><i class="fa fa-heart fa-2x" style="color: #dc3545 ; margin-top: 8px;"></i></button>
                    {!! Form::close() !!}
                </td>
            </span>
        </div>
        <!-- <div class="product-content">
            <li class="categories-title">Categories :</li>
            @foreach ($product->categories as $category)
            <li><a href="{{ url('products/category/'. $category->slug ) }}">{{ $category->name }}</a></li>
            @endforeach
            <h6><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h6>
            <p class="mb-6 text-bold">Rp {{ number_format($product->price_label()) }}</p>
        </div> -->
        <div class="card-body">
            <span class="badge badge-danger">
                @foreach ($product->categories as $category)
                <li><a style="color: white;" href=" {{ url('products/category/'. $category->slug ) }}">{{ $category->name }}</a></li>
                @endforeach
            </span>

            <h5 class="card-title"><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h5>
            <p class="card-text" style="font-weight: bold;">Rp {{ number_format($product->price_label()) }}</p>
            <a type="button" class="btn btn-outline-danger-fix btn-sm btn-block">Beli</a>
        </div>


    </div>
</div>