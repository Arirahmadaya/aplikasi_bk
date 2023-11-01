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
          <h1>Data Pelanggaran</h1>
        </div>
    </div>
    <div class="pb-3">
      <form class="d-flex" action="{{url('pelanggaran')}}" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    </div>
    <div class="pb-3">
      @if (Auth::user()->role == 'wali_kelas')
      <a href="{{url('')}}/admin/wali_kelas/create_pelanggaran" class="btn btn2 btn-primary fw-bold">+ Tambah Data</a>
      @endif
      @if (Auth::user()->role == 'guru_bk')
          <a href="{{url('')}}/admin/guru_bk/create_pelanggaran" class="btn btn2 btn-primary fw-bold">Tambah Data</a>
      @endif
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
          <th>Nis</th>
          <th>Kelas</th>
          <th>Tingkat Pelanggaran</th> 
          <th>Detail Pelanggaran</th> 
          <th>Tanggal Pelanggaran</th> 
          @if (Auth::user()->role == 'siswa')
        @else
          <th>Action</th>
          @endif
        </tr>
      </thead>
      <tbody>
        <?php $i = $data->firstItem() ?>
        @foreach ($data as $item)
        <tr>
          <td>{{ $i}}</td>
          <td>@if (!empty($item->siswa->nama))
            {{$item->siswa->nama}}
          @else
          belum di set  
          @endif </td>
          <td>@if (!empty($item->siswa->nis))
            {{$item->siswa->nis}}
          @else
          belum di set  
          @endif </td>
          <td>@if (!empty($item->siswa->kelas->kelas))
            {{$item->siswa->kelas->kelas}}
          @else
          belum di set  
          @endif </td>
          <td>
            {{$item->tingkat_pelanggaran}}

          </td>
          <td> 
            
            {{$item->detail_pelanggaran}}
        </td>
          
          <td>{{$item->tgl_pelanggaran}}</td>
          @if (Auth::user()->role == 'siswa')
        @else
          

          <td class="d-flex align-items-center">
            @if (Auth::user()->role == 'guru_bk')
          <a href="{{url('')}}/admin/guru_bk/create_konseling" class="btn btn-info btn-sm mr-1" title="Atur Jadwal Konseling">+</a>
            @endif
            <a href="{{url('pelanggaran/'.$item->id.'/edit')}}" class="btn btn-warning btn-sm mr-1">
                <i class="bi bi-pencil"></i>Edit
             </a>
             <form  class='d-inline' action="{{url('pelanggaran/'.$item->id)}}" method="post">
              @csrf
              @method('DELETE')
            <button type="submit" name="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Apakah anda yakin menghapus data tersebut?')">Delete</button>
            </form>
        </td>
        @endif
        </tr>
        <?php $i++?>    
        @endforeach
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
      </tbody>
    </table>
    {{$data->links()}}
  </div>
</section>
<!-- /.content -->
@endsection



