<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran</title>
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
    <h2>Laporan Pembayaran</h2>
    <hr>
    <p>Period : {{ \General::datetimeFormat($startDate, 'd M Y') }} - {{ \General::datetimeFormat($endDate, 'd M Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>No Pemesanan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Gateway</th>
                <th>Tipe Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->kode }}</td>
                <td>{{ \General::datetimeFormat($payment->created_at) }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ \General::priceFormat($payment->jumlah) }}</td>
                <td>{{ $payment->metode }}</td>
                <td>{{ $payment->tipe_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>