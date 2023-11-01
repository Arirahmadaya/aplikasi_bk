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
          <h1>Data Hasil Konseling</h1>
        </div>
    </div>
    <div class="pb-3">
      <form class="d-flex" action="{{url('hasil')}}" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    </div>
    <div class="pb-3">
      <a href="{{url('')}}/admin/guru_bk/create_hasil" class="btn btn2 btn-primary fw-bold"><i class="fas fa-plus"></i> Tambah Data</a> 
      <a href="{{url('')}}/admin/guru_bk/cetak_hasil" target="_blank" class="print-button btn btn-primary" ><i class="fas fa-print"></i> Cetak Laporan</a>
    
      
    </div>
  </div><!-- /.container-fluid -->
  </section>
<section class="content">
  <div class="card-body table-responsive p-0" style="height: 450px;">
    <table class="table table-bordered table-striped table-head-fixed ">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Tanggal Pelanggaran</th>
          <th>Tanggal Konseling</th>
          <th>Tingkat Pelanggaran</th>
          <th>Detail Pelanggaran</th>
          <th>Catatan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$item->konseling->pelanggaran->siswa->nama}}</td>
          <td>{{$item->konseling->pelanggaran->tgl_pelanggaran}}</td>
          <td>{{$item->konseling->jadwal_konseling}}</td>
          <td>{{$item->konseling->pelanggaran->tingkat_pelanggaran}}</td>
          <td>{{$item->konseling->pelanggaran->detail_pelanggaran}}</td>
          <td>{{$item->catatan}}</td>

          <td class="d-flex align-items-center">
              <a href="{{url('hasil/'.$item->id.'/edit')}}" class="btn btn-warning btn-sm mr-1">
                  <i class="bi bi-pencil"></i>Edit
               </a>
               <form  class='d-inline' action="{{url('hasil/'.$item->id)}}" method="post">
                @csrf
                @method('DELETE')
              <button type="submit" name="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Apakah anda yakin menghapus data tersebut?')">Delete</button>
              </form>
          </td>
        </tr>
        @endforeach
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
      </tbody>
    </table>
    {{-- {{$data->links()}} --}}
  </div>
  
</section>
<!-- /.contenty -->
@endsection



