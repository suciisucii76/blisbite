<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>ID</th>
            <th>Tipe</th>
            <th>Nominal</th>
            <th>Status</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $item)
            <tr>
                <td>{{ $item->tanggal }}</td>
                <td>#{{ $item->id }}</td>
                <td>{{ $item->tipe }}</td>
                <td>{{ $item->total_harga }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->catatan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
