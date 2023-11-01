<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pelanggaran</title>
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
    @if (Auth::user()->role == 'guru_bk')
    <a href="{{url('admin/guru_bk/pelanggaran')}}" class="btn btn-secondary"><< Kembali</a>
    @endif
    @if (Auth::user()->role == 'wali_kelas')
    <a href="{{url('admin/wali_kelas/pelanggaran')}}" class="btn btn-secondary"><< Kembali</a>
    @endif

    
</div>
<form action='{{ url('pelanggaran')}}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="id_siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
            <div class="col-sm-10">
                <select name="id_siswa" id="id_siswa" class="form-control">
                    @foreach ($siswa as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                        
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="mb-3 row">
            <label for="tingkat_pelanggaran" class="col-sm-2 col-form-label">Tingkat Pelanggaran</label>
            <div class="col-sm-10">
                <select class="form-select" name="tingkat_pelanggaran" id="tingkat_pelanggaran">
                    <option value="Ringan" {{ Session::get('tingkat_pelanggaran') == 'Ringan' ? 'selected' : '' }}>Ringan</option>
                    <option value="Sedang" {{ Session::get('tingkat_pelanggaran') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Berat" {{ Session::get('tingkat_pelanggaran') == 'Berat' ? 'selected' : '' }}>Berat</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="detail_pelanggaran" class="col-sm-2 col-form-label">Detail Pelanggaran</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='detail_pelanggaran' value="{{Session::get('detail_pelanggaran')}}" id="detail_pelanggaran">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tgl_pelanggaran" class="col-sm-2 col-form-label">Tanggal Pelanggaran</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='tgl_pelanggaran' value="{{Session::get('tgl_pelanggaran')}}" id="tgl_pelanggaran">
            </div>
        </div>


 
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>