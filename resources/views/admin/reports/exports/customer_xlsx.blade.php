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