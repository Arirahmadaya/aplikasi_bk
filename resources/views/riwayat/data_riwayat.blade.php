<!-- Main content -->
@extends("layout")
@section("content")
<section class="content-header">
    <div class="container-fluid">
      <div>
        @if (Session::has('success'))
        <div class="pt-3">
          <div class="alert alert-success">
            {{Session::get('success')}}
          </div>
        </div> 
      @endif
      </div>
      <div class="row mb-2">

        <div class="col-sm-6 pb-3">
          <h1>Data Riwayat Konseling</h1>
        </div>
    </div>
    <div class="pb-3">
      <form class="d-flex" action="{{url('riwayat')}}" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    </div>
  </div><!-- /.container-fluid -->
  </section>
<section class="content">
  <div class="card-body table-responsive p-0" style="height: 450px;">
    <table class="table table-bordered table-striped table-head-fixed text-nowrap">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Pelanggaran</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Tingkat Pelanggaran</th>
          <th>Detail Pelanggaran</th>
          <th>Tanggal Konseling</th>
          <th>Status</th>
          @if (Auth::user()->role == 'guru_bk')
          <th>Action</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$item->konseling->pelanggaran->tgl_pelanggaran}}</td>
          <td>{{$item->konseling->pelanggaran->siswa->nama}}</td>
          <td>{{$item->konseling->pelanggaran->siswa->jk}}</td>
          <td>       
          {{$item->konseling->pelanggaran->tingkat_pelanggaran}}
          </td>
          <td>
          {{$item->konseling->pelanggaran->detail_pelanggaran}}
          </td>
          <td>{{$item->konseling->jadwal_konseling}}</td>
          <td>
            @if ($item->konseling->status == 'Datang')
                <span class="text-success">{{ $item->konseling->status }}</span>
            @else
                <span class="text-danger">{{ $item->konseling->status }}</span>
            @endif
        </td>
         @if (Auth::user()->role == 'guru_bk')
         <td>
          <form  class='d-inline' action="{{url('riwayat/'.$item->id)}}" method="post">
           @csrf
           @method('DELETE')
         <button type="submit" name="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data tersebut?')">Delete</button>
         </form>
          </td>
          @endif
          
        </tr>
        @endforeach
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
      </tbody>
    </table>
    {{-- {{$data->links()}} --}}
  </div>
</section>
<!-- /.content -->
@endsection



