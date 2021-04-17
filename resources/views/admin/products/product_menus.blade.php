<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h6>Menu Produk</h6>
    </div>
    <div class="card-body">
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ url('admin/products/'. $productID .'/edit') }}">Product Detail</a>
            <a class="nav-link" href="{{ url('admin/products/'. $productID .'/images') }}">Product Gambar</a>
        </nav>
    </div>
</div>