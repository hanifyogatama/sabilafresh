<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Produk</title>
    <style type="text/css">
        table {
            width: 100%;
        }

        table tr td,
        table tr th {
            font-size: 10pt;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table th,
        td {
            border-bottom: 1px solid #ddd;
        }

        table th {
            border-top: 1px solid #ddd;
            height: 40px;
        }

        table td {
            height: 25px;
        }
    </style>
</head>

<body>
    <h2>Laporan Produk</h2>
    <hr>
    <p>Tanggal : {{ \General::datetimeFormat($startDate, 'd M Y') }} - {{ \General::datetimeFormat($endDate, 'd M Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Produk</th>
                <th>Produk Terjual</th>
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
                <td>{{ $product->sku }}</td>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->items_sold }}</td>
                <td>{{ \General::priceFormat($product->net_revenue) }}</td>
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
                <td>{{ \General::priceFormat($totalNetRevenue) }}</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
</body>

</html>