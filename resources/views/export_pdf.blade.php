<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Asuransi Kendaraan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 10px;
        }

        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr {
            page-break-inside: avoid;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>DATA ASURANSI SEMUA KENDARAAN</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Polisi</th>
                <th>Asuransi</th>
                <th>No.Polish</th>
                <th>No.Rangka</th>
                <th>No.Mesin</th>
                <th>Tahun</th>
                <th>Harga</th>
                <th>Mulai</th>
                <th>Berakhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $as)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $as->nopol }}</td>
                    <td>{{ $as->name }}</td>
                    <td>{{ $as->no_polish }}</td>
                    <td>{{ $as->rangka }}</td>
                    <td>{{ $as->mesin }}</td>
                    <td>{{ $as->tahun }}</td>
                    <td>Rp{{ number_format($as->harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($as->start)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($as->end)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
