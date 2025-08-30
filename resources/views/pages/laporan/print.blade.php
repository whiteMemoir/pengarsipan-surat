<!DOCTYPE html>
<html>

<head>
    <title>Laporan Surat</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #3490dc;
            color: #fff;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h3><i class="fa fa-file"></i> Laporan Surat {{ request('tipe') == 'masuk' ? 'Masuk' : 'Keluar' }}</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surat as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->tanggal }}</td>
                    <td>{{ strtoupper($s->status) }}</td>
                    <td>{{ $s->total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
