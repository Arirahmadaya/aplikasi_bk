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
          <h1>Data Konseling</h1>
        </div>
    </div>
    <div class="pb-3">
      <form class="d-flex" action="{{url('konseling')}}" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    
    </div>
    @if (Auth::user()->role == 'siswa')
    @else
    <div>
      <a href="{{url('')}}/admin/guru_bk/riwayat" class="btn btn-info btn-sm mr-1" title="Atur Jadwal Konseling">Riwayat</a>
    </div>
    @endif
  </div>
  </section>
<section class="content">
  <div class="card-body table-responsive p-0" style="height: 450px;">
    <table class="table table-bordered table-striped table-head-fixed ">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Pelanggaran</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Tingkat Pelanggaran</th>
          <th>Detail Pelanggaran</th>
          <th>Jadwal Konseling</th>
          <th>Status</th>
          @if (Auth::user()->role == 'siswa')
          @else
            <th>Action</th>
            @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$item->pelanggaran->tgl_pelanggaran}}</td>
          <td>{{$item->pelanggaran->siswa->nama}}</td>
          <td>{{$item->pelanggaran->siswa->jk}}</td>
          <td>
            {{$item->pelanggaran->tingkat_pelanggaran}}

          </td>
          <td> 
            {{$item->pelanggaran->detail_pelanggaran}}
          </td>
          <td>{{$item->jadwal_konseling}}</td>
          <td>
            @if ($item->status == 'Datang')
                <span class="text-success">{{ $item->status }}</span>
            @elseif ($item->status == 'Sedang Dipanggil')
                <span class="text-warning">{{ $item->status }}</span>
            @else
                <span class="text-danger">{{ $item->status }}</span>
            @endif
        </td>
        @if (Auth::user()->role == 'siswa')
        @else    
          <td class="d-flex align-items-center">
            <a href="{{url('')}}/admin/guru_bk/create_riwayat" class="btn btn-info btn-sm mr-1" title="Tambahkan data ke riwayat">+</a>

            <a href="{{url('konseling/'.$item->id.'/edit')}}" class="btn btn-warning btn-sm mr-1">
              <i class="fas fa-edit"></i>
             </a>
             <form  class='d-inline' action="{{url('konseling/'.$item->id)}}" method="post">
              @csrf
              @method('DELETE')
            <button type="submit" name="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Apakah anda yakin menghapus data tersebut?')"> <i class="fa fa-trash"></i></button>
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



