@extends('layouts.index')

@section('title', 'Groups')

@section('content')

<!-- ======= About Section ======= -->
<section id="portfolio" class="about">
  <div class="container">

    <div class="section-title">
      <h2 class="mt-5">Groups</h2>
      <h3>Check our <span>Groups</span></h3>
      <div class="d-flex flex-wrap justify-content-center">
      @php
          // menampilkan jumlah data-data 
          $count = DB::table('groups')->count();
          echo '<div style="width: 7rem;"><h3><span>'.$count.'</span></h3><i>Groups Available</i></div>';
          
          $price = DB::table('history_groups')->max('id');
          echo '<div style="width: 7rem;"><h3><span>'.$price.'</span></h3><i>Groups ever Created</i></div>';
          
          echo '<div style="width: 7rem;"><h3><span>'.$price - $count.'</span></h3><i> Deleted </i> </div>';
      @endphp
      </div>
    </div>

    <div class="row content">
        <a href="/groups/create" class="btn-learn-more my-3 col-lg-2 text-center" title="Tambah Group" data-bs-toggle="modal" data-bs-target="#createModal">New Group +</a>
        <div class="d-flex flex-wrap justify-content-center">

          {{-- menampilkan data dari groups --}}
          @foreach ($groups as $group)

          <div class="card m-3 border-danger" style="width: 18rem;">
            <div class="card-body">
              <a class="text-decoration-none" href="/groups/{{ $group['id'] }}/#show">
                {{-- tampil nama groups  --}}
                <h3 class="card-title">{{ $group['name'] }}</h3>
                {{-- tampil description groups  --}}
                <h5 class="card-subtitle mb-2 text-muted">{{ $group['description'] }}</h5>
              </a>

              {{-- list member --}}
              <hr>
              <h5><b>{{ $group['name'] }} - Member List</b></h5>
              <div style="width: 16rem;height: 200px;" class="overflow-auto mt-2">
                <ul class="list-group">
                  @foreach ($group->friends as $friend)
                  <li class="border-danger list-group-item d-flex justify-content-between align-items-center">
                    {{-- tampil nama member  --}}
                    <h5>{{$friend->nama}}</h5>
                    <span class="">
                      <form action="/groups/deletemember/{{$friend->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-danger m-2 d-flex " data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure?')">X</button>
                      </form>
                    </span>
                  </li>
                  @endforeach
                </ul>
                
              </div>        
              <a class="btn btn-outline-primary" href="/groups/addmember/{{ $group['id'] }}/#add" role="button">+ New Member {{ $group['name'] }}</a>
            <hr>
          {{-- end list --}}
          
              {{-- tombol  --}}
              <div class="d-flex flex-wrap mt-3">
                <a class="btn btn-outline-success m-2 d-flex justify-content-center" href="/groups/{{ $group['id'] }}/edit/#edit" role="button"><i class="bi bi-pencil-square"></i></a>
                <form action="/groups/{{$group['id']}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-outline-danger m-2 d-flex " data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                </form>
              </div>

            </div>
          </div>

          @endforeach

        </div>
        {{-- create MODAL membuat groups--}}
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Friend</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="/groups/#portfolio" method="POST">
                  @csrf
                  <div class="form-group">
                    {{-- input nama  --}}
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" required value="{{ old('nama') }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    {{-- input description  --}}
                    <label for="exampleInputPassword1" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="exampleInputPassword1" required value="{{ old('description') }}">
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <div class="modal-footer mt-3">
                    {{-- tombol  --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close" role="button">Cancel</a>
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
</section><!-- End About Section -->

@endsection