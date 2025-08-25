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

        .signature .menerima {
            float: left;
            width: 30%;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>SURAT KUASA</h2>
    <div class="section">
        <p style="margin-bottom: 10px;">Saya yang bertanda tangan di bawah ini:</p>
        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td style="width: 33%;">Nama</td>
                <td style="width: 2%;">:</td>
                <td style="width: 170%;">Haryadi Djaya</td>
            </tr>
            <tr>
                <td style="width: 33%;">No.KTP</td>
                <td>:</td>
                <td>3175032705700001</td>
            </tr>
            <tr>
                <td style="width: 33%;">Alamat</td>
                <td>:</td>
                <td>Jl. Bekasi Timur VI/3 Rt/Rw : 008/009 Desa Cipinang Besar Utara Kec. Jatinegara</td>
            </tr>
            <tr>
                <td style="width: 33%;">Pekerjaan</td>
                <td>:</td>
                <td>Direktur</td>
            </tr>
        </table>
    </div>


    <div class="section" style="margin-top: 20px;">
        <p style="margin-bottom: 10px;">Dengan ini memberikan kuasa kepada:</p>
        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td style="width: 33%;">Nama</td>
                <td style="width: 2%;">:</td>
                <td style="width: 170%;">
                    {{ $kendaraan->kir?->karyawan?->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 33%;">No.KTP</td>
                <td>:</td>
                <td>{{ $kendaraan->kir?->karyawan?->no_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 33%;">Alamat</td>
                <td>:</td>
                <td>{{ $kendaraan->kir?->karyawan?->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 33%;">Pekerjaan</td>
                <td>:</td>
                <td>{{ $kendaraan->kir?->karyawan?->pekerjaan ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="section" style="margin-top: 20px;">
        <p style="margin-bottom: 10px;">Untuk mengurus Perpanjangan KIR Bus dengan data kendaraan dibawah ini :</p>
        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td style="width: 33%;">Nomor Polisi</td>
                <td style="width: 2%;">:</td>
                <td style="width: 170%;">{{ $kendaraan->nopol ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="width: 33%;">Merk Mobil</td>
                <td>:</td>
                <td>{{ $kendaraan->merk ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="width: 33%;">Nomor Rangka</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->rangka ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="width: 33%;">Nomor Mesin</td>
                <td>:</td>
                <td style="width: 90%;">{{ $kendaraan->mesin ?? '-' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="section" style="margin-top: 20px;">
        <p>Demikian surat kuasa ini saya buat untuk digunakan sebagaimana mestinya.</p>
    </div>

    <div class="signature">
        <div class="menerima">
            <p>&nbsp;</p>
            <p style="margin: 10px 0 0">Hormat Kami,</p>
            <br><br><br>
            <p style="margin: 30px 0 0"><u>Haryadi Djaya</u></p>
            <p style>Direktur</p>
        </div>
    </div>
</body>

</html>
