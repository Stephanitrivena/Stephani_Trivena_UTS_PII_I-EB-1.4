@extends('layouts.index')

@section('title', 'Friends')

@section('content')

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2 class="mt-5">Friends</h2>
          <h3>My <span>Friends</span></h3>
          <div class="d-flex flex-wrap justify-content-center">
            @php
              // menampilkan jumlah data-data 
              $count = DB::table('friends')->count();
              echo '<div style="width: 7rem;"><h3><span>'.$count.'</span></h3><i> Friends </i></div>';
              $price = DB::table('history_friends')->max('id');
              echo '<div style="width: 7rem;"><h3><span>'.$price.'</span></h3><i> Friends ever Created </i></div>';
              
              echo '<div style="width: 7rem;"><h3><span>'.$price - $count.'</span></h3><i> Deleted </i></div>';
              
              @endphp
          </div>

        </div>

        <div class="row content">
            <a type="button" class="btn-learn-more my-3 col-lg-2 text-center" title="Tambah Teman" data-bs-toggle="modal" data-bs-target="#createModal">New Friend +</a>
            
            <div class="d-flex flex-wrap justify-content-center">

              {{-- menampilkan data friends  --}}
              @foreach ($friends as $friend)

              <div class="card m-3 border-danger" style="width: 15rem;">
                <div class="card-body">
                  <a class="text-decoration-none" href="/friends/{{ $friend['id'] }}/#show" title="Klik Untuk Melihat">
                    <h3 class="card-title">{{ $friend['nama'] }}</h3>
                    <h6 class="card-subtitle mb-2 text-muted">No Tlp : {{ $friend['no_tlp'] }}</h6>
                    <p class="card-text">Address : {{ $friend['alamat'] }}</p>
                    </p>
                    
                  </a>

                  <div class="d-flex flex-wrap mt-3">
                    <a class="btn btn-outline-success m-2 d-flex justify-content-center" title="Edit" href="/friends/{{ $friend['id'] }}/edit/#edit" role="button" ><i class="bi bi-pencil-square"></i></a>

                    <form action="/friends/{{$friend['id']}}/#about" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline-danger m-2 d-flex " data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                    </form>

                  </div>

                </div>
              </div>

              @endforeach

            </div>

            {{-- create MODAL//menambahkan data friends--}}
              <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">New Friend</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/friends/#about" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          {{-- input nama  --}}
                          <label for="exampleInputEmail1" class="form-label">Nama</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" required value="{{ old('nama') }}">
                          @error('nama')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          {{-- input no telppon --}}
                          <label for="exampleInputPassword1" class="form-label">No Telpon</label>
                          <input type="number" class="form-control" name="no_tlp" id="exampleInputPassword1" required value="{{ old('no_tlp') }}">
                          @error('no_tlp')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          {{-- input alamat  --}}
                          <label for="exampleInputPassword1" class="form-label">Alamat</label>
                          <input type="text" class="form-control" name="alamat" id="exampleInputPassword1" required value="{{ old('alamat') }}">
                          @error('alamat')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        
                        <div class="modal-footer">
                          {{-- tombol --}}
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <a class="btn btn-outline-danger" role="button" data-bs-dismiss="modal">Cancel</a>
                        </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>
            {{-- endModal --}}

          </div>
        </div>
      </div>
    </section><!-- End  Section -->

@endsection