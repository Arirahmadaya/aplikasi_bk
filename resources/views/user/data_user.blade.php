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
        <h1>Data User</h1>
      </div>
    </div>
    <div class="pb-3">
      <form class="d-flex" action="{{ url('user') }}" method="get">
        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
        <button class="btn btn-success" type="submit" style="background-color: #015f10; border-color: #015f10;">Cari</button>
      </form>
    </div>
    <div class="pb-3">
      @if (Auth::user()->role == 'operator')
      <a href="{{ url('admin/operator/create_user') }}" class="btn btn2 btn-primary fw-bold">+ Tambah Data</a>
      @endif
      @if (Auth::user()->role == 'guru_bk')
      <a href="{{ url('admin/guru_bk/create_user') }}" class="btn btn2 btn-primary fw-bold">Tambah Data</a>
      @endif
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="card-body table-responsive p-0" style="height: 450px;">
    <table class="table table-bordered table-striped table-head-fixed">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Password</th>
          <th>Level</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = $data->firstItem() ?>
        @foreach ($data as $item)
        <tr>
          <td>{{ $i }}</td>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->email }}</td>
          <td>{{ $item->password }}</td>
          <td>{{ $item->role }}</td>
          <td class="d-flex align-items-center">
            <a href="{{ url('user/'.$item->id.'/edit') }}" class="btn btn-warning btn-sm mr-1">
              <i class="bi bi-pencil"></i>Edit
            </a>
            <form class="d-inline" action="{{ url('user/'.$item->id) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" name="submit" class="btn btn-danger btn-sm mr-1" onclick="return confirm('Apakah anda yakin menghapus data tersebut?')">Delete</button>
            </form>
          </td>
        </tr>
        <?php $i++ ?>    
        @endforeach
      </tbody>
    </table>
    {{ $data->links() }}
  </div>
</section>
@endsection
