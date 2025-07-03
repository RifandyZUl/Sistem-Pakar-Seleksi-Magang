<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Perhitungan - {{ strtoupper($metode) }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Hasil Perhitungan Metode {{ strtoupper($metode) }}</h2>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">Peringkat</th>
                <th style="width: 50%;">Nama Alternatif</th>
                <th style="width: 40%;">
                    @if ($metode === 'vikor')
                        Skor VIKOR (Q)
                    @else
                        Skor WP
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>
                        {{ number_format($row[$metode === 'vikor' ? 'nilai_q' : 'nilai_v'], 5) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y H:i') }}
    </div>
</body>
</html>
