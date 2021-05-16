<table>
    <thead>
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Items Sold</th>
            <th>Pendapatan</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalNetRevenue = 0;
        @endphp
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->nama_produk }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->items_sold }}</td>
            <td>{{ $product->net_revenue }}</td>

            <td>{{ $product->stock }}</td>
        </tr>

        @php
        $totalNetRevenue += $product->net_revenue;
        @endphp
        @endforeach
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{ $totalNetRevenue }}</td>

            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>