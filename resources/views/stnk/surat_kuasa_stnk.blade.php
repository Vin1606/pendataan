<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Kuasa Perpanjangan STNK</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 40px;
            line-height: 1.5;
            font-size: 14px;
        }

        p {
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            text-decoration: underline;
            margin: 120px 0 5px;
        }

        .section {
            margin-top: 40px;
        }

        .signature {
            margin-top: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .signature .memberi {
            float: right;
            width: 60%;
            text-align: center;
        }

        .signature .menerima {
            float: left;
            width: 30%;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>SURAT KUASA</h2>
    <p style="text-align: center;">Nomor : 55/SK/STNK/2024</p>

    <div class="section">
        <p>Yang bertanda tangan di bawah ini:</p>
        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Nama</td>
                <td style="width: 2%;">:</td>
                <td style="width: 90%;">Juningsih Sutjiono</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Jabatan</td>
                <td>:</td>
                <td>Komisaris</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">No. KTP</td>
                <td>:</td>
                <td>3175036802650003</td>
            </tr>
        </table>
    </div>


    <div class="section" style="margin-top: 20px;">
        <p>Dengan ini memberikan kuasa kepada:</p>
        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Nama</td>
                <td style="width: 2%;">:</td>
                <td style="width: 90%;">Gobala Krisna</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Jabatan</td>
                <td>:</td>
                <td>Karyawan</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">No. KTP</td>
                <td>:</td>
                <td>Komplek Bulevar Hijau blok I8 No. 11A Bekasi</td>
            </tr>
        </table>
    </div>

    <div class="section" style="margin-top: 20px;">
        <p>Untuk pengurusan Perpanjangan STNK Kendaraan:</p>
        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Nomor Polisi</td>
                <td style="width: 2%;">:</td>
                <td style="width: 90%;">{{ $kendaraan->nopol }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Merk/Type</td>
                <td>:</td>
                <td>{{ $kendaraan->merk }} / {{ $kendaraan->type }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Model</td>
                <td>:</td>
                <td>{{ $kendaraan->model }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Tahun Pembuatan</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->tahun }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Tahun Perakitan</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->tahun }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Isi Silinder</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->silinder }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Warna</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->warna }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Nomor Rangka</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->rangka }}</td>
            </tr>
            <tr>
                <td style="width: 33%; padding: 0 0 0 40px;">Nomor Mesin</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->mesin }}</td>
            </tr>
        </table>
    </div>

    <div class="section" style="margin-top: 20px;">
        <p>Demikian surat kuasa ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="signature">
        <div class="menerima">
            <p>&nbsp;</p>
            <p style="margin: 35px 0 0">Yang menerima kuasa,</p>
            <br><br><br>
            <p style="margin: 30px 0 0"><strong>(Gobala Krisna)</strong></p>
        </div>
        <div class="memberi">
            <p style="margin: 25px 0 0">Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p style="margin: 10px 0 0">Yang Memberi Kuasa,</p>
            <br><br><br>
            <p style="margin: 30px 0 0"><strong>(Juningsih Sutjiono)</strong></p>
        </div>
    </div>
</body>

</html>
