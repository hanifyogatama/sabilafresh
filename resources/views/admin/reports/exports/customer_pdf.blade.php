<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pelanggan</title>
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
    <h2>Laporan Pelanggan</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No Hp</th>
                <th>Alamat</th>
                <th>Tgl Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->nama_depan }} {{ $customer->nama_belakang }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->no_hp }}</td>
                <td>{{ $customer->alamat }}</td>
                <td>{{ date('d F Y', strtotime($customer->created_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>