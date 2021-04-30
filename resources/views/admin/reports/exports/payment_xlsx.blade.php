<table>
    <thead>
        <tr>
            <th>No Pemesanan</th>
            <th>Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Gateway</th>
            <th>Tipe Pembayaran</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr>
            <td>{{ $payment->kode }}</td>
            <td>{{ $payment->created_at }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->jumlah }}</td>
            <td>{{ $payment->metode }}</td>
            <td>{{ $payment->tipe_pembayaran }}</td>
        </tr>
        @endforeach
    </tbody>
</table>