<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Riwayat Konseling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <main class="container">
<!-- START FORM -->
@if ($errors->any())
<div class="pt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
            <li>{{$item}}</li>          
            @endforeach
        </ul>
    </div>
</div>
    
@endif

<div>
    @if (Auth::user()->role == 'operator')
    <a href="{{url('admin/operator/konseling')}}" class="btn btn-secondary"><< Kembali</a>
    @endif
    @if (Auth::user()->role == 'guru_bk')
    <a href="{{url('admin/guru_bk/konseling')}}" class="btn btn-secondary"><< Kembali</a>
    @endif
    @if (Auth::user()->role == 'wali_kelas')
    <a href="{{url('admin/wali_kelas/konseling')}}" class="btn btn-secondary"><< Kembali</a>
    @endif

</div>

<form action='{{ url('riwayat')}}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="id_konseling" class="col-sm-2 col-form-label">Konseling</label>
            <div class="col-sm-10">
                <select name="id_konseling" id="id_konseling" class="form-control">
                    @foreach ($konseling as $item)
                    <option value="{{$item->id}}">Tanggal: {{$item->pelanggaran->tgl_pelanggaran}} - Nama: {{$item->pelanggaran->siswa->nama}} - JK: {{$item->pelanggaran->siswa->jk}} - Tingkat: {{$item->pelanggaran->tingkat_pelanggaran}} - Detail: {{$item->pelanggaran->detail_pelanggaran}}  - Status: {{$item->status}}</option>                   
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">TAMBAHKAN DATA KE RIWAYAT</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>