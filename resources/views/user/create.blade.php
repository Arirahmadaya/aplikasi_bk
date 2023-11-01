<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data User</title>
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
<form action='{{ url('user')}}' method='post'>
    @csrf

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{Session::get('nama')}}" id="nama">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name='email' value="{{Session::get('email')}}" id="email">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name='password' value="{{Session::get('password')}}" id="password">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Level</label>
            <div class="col-sm-10">
                <select class="form-select" name="role" id="role">
                    <option value="">Pilih Level</option>
                    <option value="operator" {{ Session::get('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                    <option value="guru_bk" {{ Session::get('role') == 'guru_bk' ? 'selected' : '' }}>Guru BK</option>
                    <option value="wali_kelas" {{ Session::get('role') == 'wali_kelas' ? 'selected' : '' }}>Wali Kelas</option>
                    <option value="siswa" {{ Session::get('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>
        </div>
 
        <div class="mb-3 row">
            <label for="user" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>