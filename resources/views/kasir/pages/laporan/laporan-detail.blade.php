<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Keuntungan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $key => $l)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $l->namaBarang }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
