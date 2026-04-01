<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Terima Pengambilan STNK</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .content {
            margin-top: 20px;
        }

        .content p {
            margin: 5px 0;
        }

        .details-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .details-table td {
            padding: 8px;
            vertical-align: top;
        }

        .details-table tr td:first-child {
            width: 180px;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .signatures {
            margin-top: 60px;
            width: 100%;
        }

        .signatures td {
            width: 50%;
            text-align: center;
            padding-top: 70px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Tanda Terima Pengambilan Dokumen</h1>
        </div>

        <div class="content">
            <p>Pada hari ini, {{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}, telah diserahkan kembali
                dokumen hasil perpanjangan pajak STNK tahunan, dengan rincian sebagai berikut:</p>

            <table class="details-table">
                <tr>
                    <td>Nomor Polisi</td>
                    <td>: {{ $kendaraan->nopol }}</td>
                </tr>
                <tr>
                    <td>Nama Pemilik (di STNK)</td>
                    <td>: {{ $kendaraan->pemilik }}</td>
                </tr>
                <tr>
                    <td>Merk / Type</td>
                    <td>: {{ $kendaraan->merk }} / {{ $kendaraan->type }}</td>
                </tr>
                <tr>
                    <td>Nomor Rangka</td>
                    <td>: {{ $kendaraan->rangka }}</td>
                </tr>
                <tr>
                    <td>Nomor Mesin</td>
                    <td>: {{ $kendaraan->mesin }}</td>
                </tr>
                <tr>
                    <td>Masa Berlaku Pajak Baru</td>
                    <td>: ............................................</td>
                </tr>
            </table>

            <p class="section-title">Dokumen yang diserahkan kembali:</p>
            <ol>
                <li>STNK Asli (Telah diperpanjang)</li>
            </ol>

            <p>Dengan diterimanya dokumen di atas, maka proses perpanjangan pajak STNK untuk kendaraan tersebut telah
                selesai.</p>
        </div>

        <table class="signatures">
            <tr>
                <td>
                    <p>Yang Menyerahkan,</p>
                    <br><br><br><br>
                    <p>(_________________________)</p>
                </td>
                <td>
                    <p>Yang Menerima,</p>
                    <br><br><br><br>
                    <p>(_________________________)</p>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
