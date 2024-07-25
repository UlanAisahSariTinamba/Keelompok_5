
@extends('dashboard.layouts.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  
    <h1 class="h2">Kategori Berita : {{ $kategori }} </h1>
</div>

            {{-- Form search --}}
            {{-- <div class="row">
                <div class="col-md-12">
                  <form action="/dashboard/berita/kategori">
                    @if(request('kategori'))
                      <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Search.." name="kategori" value="{{ request('kategori') }}">
                      <button class="btn btn-primary" type="submit">Search..</button>
                    </div>
                  </form>
                </div>
              </div> --}}

              {{-- Pengecekan Erorr  --}}
              @if (session()->has('success_message'))
              {{-- Jika ada error tampilkan pesan --}}
                  <div class="alert alert-success text-center">
                      {{ session()->get('success_message') }}
                  </div>
              @endif

                 
 {{-- Tabel Berita --}}
 <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>                  
      <th scope="col">Judul</th>
      <th scope="col">User</th>
      <th scope="col">Kategori</th>
      <th scope="col">Publish at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>               
    {{-- @foreach ($kategori as $key => $kateg) --}}
    @foreach ($berita as $key =>  $brt)
    <tr>                               
      <th scope="row">{{ $berita->firstItem() + $key }}</th>                   
      {{-- <th scope="row">#</th>                    --}}
      {{-- <td>
          @if($brt->gambar)
          <img src="{{ url('gambar_komik').'/'. $brt->gambar }}" alt="" width="100" class="img img-fluid rounded">
          @endif             
        </td> --}}
      <td>
        <a href="/dashboard/berita/{{ $brt->slug }}" class="link-dark text-decoration-none">{{ $brt->judul }}</a>                
    </td>
      <td>{{ $brt->user->name }}</td>
      <td>
        {{ $kategori }}
      {{-- <a href="/dashboard/berita/kategori/{{ $brt->kategori_berita->slug }}"> {{ $kategori }}</a>       --}}
      </td>
      <td>{{ $brt->published_at }}</td>
      <td>                      
          {{-- <a href="{{ "berita/$brt->id" }}" class="btn btn-success btn-sm">View</a> --}}
          <a href="{{ "berita/$brt->slug/edit" }}" class="btn btn-primary btn-sm">Edit</a>                           
          <span class="d-inline-block">
            <form method="POST" action="/dashboard/berita/{{ $brt->slug }}" class="inline-block">
              @method('DELETE')
              @csrf                 
              <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" >Hapus</button>
              </form>
          </span>        
      </td>
    </tr>    
    @endforeach
  </tbody>
</table>
       

    {{ $berita->links() }}
        
@endsection