@extends('layouts.index')

@section('title', 'Friends')

@section('content')

<section id="edit" class="about">
  <div class="container">

    <div class="section-title">
      <h2 class="mt-5">Friends</h2>
      <h3>Edit <span>Friends</span></h3>
      
    </div>
    <div class="row content">
      <div class="d-flex flex-wrap justify-content-center">
          <div class="card m-3 border-danger" style="width: 20rem;">
            <div class="card-body">
              {{-- mengambil data lalu menampilkan nya di tampilan edit friends  --}}
              <form action="/friends/{{ $friends['id'] }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group m-3">
                  <label for="exampleInputEmail1">Nama</label>
                  {{-- untuk edit nama  --}}
                <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" value="{{ old('nama') ? old('nama') : $friends['nama'] }}">
                  @error('nama')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group m-3">
                  {{-- untuk edit no tlp  --}}
                  <label for="exampleInputPassword1">No Telpon</label>
                  <input type="number" class="form-control" name="no_tlp" id="exampleInputPassword1" value={{ old('no_tlp')? old('no_tlp') : $friends['no_tlp'] }}>
                  @error('no_tlp')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group m-3">
                  {{-- untuk edit alamat  --}}
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" name="alamat" id="alamat" value={{ old('alamat')? old('alamat') : $friends['alamat'] }}>
                  @error('alamat')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class=" mt-3">
                  {{-- tombol  --}}
                  <button type="submit" class="btn btn-success">Update</button>
                  <a class="btn btn-outline-danger" href="/#about" role="button">Cancel</a>
                </div>
              </form>

            </div>

          </div>
        </div>
      </div>
  </div>
</section> 

    
@endsection