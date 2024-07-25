@extends('dashboard.layouts.main')
@section('container')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kategori Berita
      <a class="btn btn-success btn-sm" href="/dashboard/kategori_berita/create">+ Tambah Data</a>
    </h1>
</div>
    
           {{-- Form search --}}
           <div class="row">
            <div class="col-md-12">
              <form action="/dashboard/kategori_berita">
              
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                  <button class="btn btn-primary" type="submit">Search..</button>
                </div>
              </form>
            </div>
          </div>

                {{-- Notifikasi --}}
                {{-- Jika ada Natifikasi tampilkan pesan --}}
                {{-- @if (session()->has('success_message'))             
                    <div class="alert alert-success text-center">
                        {{ session()->get('success_message') }}
                    </div>
                @endif --}}

                @if($kategori_berita->count())                  
                {{-- Tabel kategoriBerita --}}
                <table class="table table-hover">
                 <thead>
                   <tr>
                     <th scope="col">#</th>                  
                     <th scope="col">Nama</th>
                     <th scope="col">Id kategori</th>              
                     <th scope="col">Action</th>
                   </tr>
                 </thead>
                 <tbody>               
                   @foreach ($kategori_berita as $key => $kt_berita)
                  
                   <tr>                               
                     <th scope="row">{{ $kategori_berita->firstItem() + $key }}</th>                   
                                  
                  
                     <td>{{ $kt_berita->nama }} </td>
                     <td>{{ $kt_berita->id }}</td>
                     <td>
                      <a href="/dashboard/kategori_berita/{{ $kt_berita->slug }}/edit"class="btn btn-primary btn-sm">Edit</a>  

                      <span class="d-inline-block">
                        <form method="POST" action="/dashboard/kategori_berita/{{ $kt_berita->slug }}" class="inline-block">
                          @method('DELETE')
                          @csrf                 
                          {{-- <button  type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin menghapus data?.')" id="delete">Hapus</button> --}}
                          <button  type="submit" class="btn btn-danger btn-sm show_confirm"  data-toggle="tooltip" title='Delete'>Hapus</button>
                          </form>
                      </span>        
                     </td>
                   </tr>    
                   @endforeach
                 </tbody>
               </table>
                 @else
                 <p class="fs-5"> <b> No search found. </b> </p>
                 @endif            
               
                   {{ $kategori_berita->links() }}

{{-- Sweet alert --}}
@if (session()->has('success_message'))             
  <script>
  swal.fire("{!! Session::get('success_message') !!}", "", "success", {
  button:"Ok"
  });                  
  </script>
@endif

{{-- Konfirmasi Hapus Data dengan Sweet Alert --}}
<script> 
 $('.show_confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      Swal.fire({
          title: 'Anda yakin?',
          text: "Akan Menghapus Data Pilih Yes atau Cancel",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!'
         
          }).then((result) => {            
            if (result.isConfirmed) {              
              Swal.fire(
                "Success",
                "Deleted Data!",
                "success"
              )
              form.submit();
            }

      });
  });

</script>
                
@endsection