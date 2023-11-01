<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kelas</title>
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
<form action='{{ url('siswa/'.$data->id)}}' method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nis' value="{{$data->nis}}" id="nis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{$data->nama}}" id="nama">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Tempat Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='tmp_lahir' value="{{$data->tmp_lahir}}" id="tmp_lahir">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='tgl_lahir' value="{{$data->tgl_lahir}}" id="tgl_lahir">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
                <select class="form-select" name="jk" id="jk">
                    <option value="Laki-Laki" {{$data->jk == 'Laki-Laki' ? 'selected' : ''}}>Laki-Laki</option>
                    <option value="Perempuan" {{$data->jk == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                </select>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">No HP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nohp' value="{{$data->nohp}}" id="nohp">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">No HP Ortu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nohp_ortu' value="{{$data->nohp_ortu}}" id="nohp_ortu">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
                <select name="id_kelas" id="id_kelas" class="form-control">
                    @foreach ($kelas as $item)
                    <option value="{{$item->id}}">{{$item->kelas}}</option>
                    @endforeach
                </select>
            </div>
        </div>
 
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='alamat' value="{{$data->alamat}}" id="alamat">
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