<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Konseling</title>
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
<div><a href="{{url('admin/guru_bk/pelanggaran')}}" class="btn btn-secondary"><< Kembali</a></div>

<form action='{{ url('konseling')}}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="id_pelanggaran" class="col-sm-2 col-form-label">Pelanggaran</label>
            <div class="col-sm-10">
                <select name="id_pelanggaran" id="id_pelanggaran" class="form-control">
                    @foreach ($pelanggaran as $item)
                    <option value="{{$item->id}}">Tanggal: {{$item->tgl_pelanggaran}} - Nama: {{$item->siswa->nama}} - JK: {{$item->siswa->jk}} - Tingkat: {{$item->tingkat_pelanggaran}} - Detail: {{$item->detail_pelanggaran}}</option>                   
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="jadwal_konseling" class="col-sm-2 col-form-label">Jadwal Konseling</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='jadwal_konseling' value="{{Session::get('jadwal_konseling')}}" id="jadwal_konseling">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-select" name="status" id="status">
                    <option value="Sedang Dipanggil" {{ Session::get('status') == 'Sedang Dipanggil' ? 'selected' : '' }}>Sedang Dipanggil</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">ATUR JADWAL KONSELING</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>