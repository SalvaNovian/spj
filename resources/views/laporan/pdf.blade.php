<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Laporan SPJ</title>

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table,th,td{
            border:1px solid #000;
        }

        th{
            background:#e9ecef;
        }

        th,td{
            padding:8px;
        }

    </style>

</head>

<body>

<h2>

LAPORAN SPJ

</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>No SPJ</th>
<th>Kegiatan</th>
<th>User</th>
<th>Tanggal</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($laporan as $item)

<tr>

<td>{{ $loop->iteration }}</td>
<td>{{ $item->nomor_spj }}</td>
<td>{{ $item->kegiatan->nama }}</td>
<td>{{ $item->user->nama }}</td>
<td>{{ $item->tanggal }}</td>
<td>{{ ucfirst($item->status) }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>