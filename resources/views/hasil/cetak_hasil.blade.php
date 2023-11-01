<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    th, td {
      border: 1px solid #000;
      padding: 8px;
    }
    
    th {
      background-color: #f2f2f2;
    }
    
    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    
    tbody tr:hover {
      background-color: #e6e6e6;
    }
    
    .header {
      display: flex;
      align-items: center;
      padding: 10px;
    }
    
    .header h3,
    .header p {
      margin: 0;
      color: green;
    }
    
    .header img {
      height: 120px;
      margin-right: 10px;
    }

  </style>
</head>
<body>
  <div class="header">
    <img src="../../dist/img/logosekolah.png" alt="logo sekolah">
    <div style="text-align: center;">
      <h3>KEMENTERIAN AGAMA</h3>
      <h3>MADRASAH ALIYAH AL-FATAH</h3>
      <h3>YAYASAN PEMBANGUNAN UIN RADEN FATAH PALEMBANG</h3>
      <p style="font-size: 14px">Jalan Prof. KH. Zainal Abidin Fikri (Komplek UIN Raden Fatah) km. 3,5 Palembang 30126</p>
      <p style="font-size: 14px">Telepon (0711) 357071 | Email madrasahaliyahalfatah@gmail.com</p>
    </div>
  </div>
  <div style="border-top: 5px solid #007c15; margin-top: 1em; padding-top: 0.2em;">
  <div style="border-top: 1px solid #007c15; margin-top: 0em; padding-top: 1em;">
  </div>
  <div style="text-align: center;">
    <h3 style="display: inline-block; border-bottom: 2px solid; padding-bottom: 0;">LAPORAN HASIL KONSELING</h3>

  </div>
  
 </div>
  <div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Tanggal Pelanggaran</th>
          <th>Tanggal Konseling</th>
          <th>Tingkat Pelanggaran</th>
          <th>Detail Pelanggaran</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($hasil as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$item->konseling->pelanggaran->siswa->nama}}</td>
          <td>{{$item->konseling->pelanggaran->tgl_pelanggaran}}</td>
          <td>{{$item->konseling->jadwal_konseling}}</td>
          <td>{{$item->konseling->pelanggaran->tingkat_pelanggaran}}</td>
          <td>{{$item->konseling->pelanggaran->detail_pelanggaran}}</td>
          <td>{{$item->catatan}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <?php
function getMonthInIndonesian($monthNumber) {
    $months = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    return $months[$monthNumber];
}
?>

<div style="text-align: right; margin-top: 2em;">
    <p>Palembang, {{ date('d') }} {{ getMonthInIndonesian(date('n')) }} {{ date('Y') }}</p>
    <p>Guru Bimbingan Konseling</p>
    <br>
    <br>
    <br>
    <p style="text-decoration: underline;">Muhammad Mulya Rahman, S.Sos</p>
</div>
  <script type="text/javascript">
    window.print(); 
  </script>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 0;
      }
    }
  </style>
</body>
</html>
