@extends('layouts.index')

@section('title', 'Coba')

@section('content')
<section id="show" class="about">
    <div class="container">
  
      <div class="section-title">
        <h2 class="mt-5">Groups</h2>
        <h3>Detail <span>Groups</span></h3>
        <a class="btn btn-outline-primary mt-5" href="/groups/#portfolio" role="button">Back</a>
      </div>
      <div class="row content">
          <div class="d-flex flex-wrap justify-content-center">
            <div class="card my-4 border-danger" style="width: 20rem;">
                <div class="card-body my-2">
                  {{-- tampil nama groups  --}}
                  <h3 class="card-title my-2"> Name : {{ $group['name'] }} </h3>
                  {{-- tampil Description groups  --}}
                  <h5 class="card-subtitle my-2"> Description : {{ $group['description'] }} </h5>
                  {{-- list --}}
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
                </div>
            </div>
            
            {{-- hitung data-data --}}
            <div class="card my-4 border-danger" style="width: 20rem;">
              <div class="card-body my-2">
                @php
                    $id = $group['id'];
                    $count = DB::table('friends')->where('groups_id','=',$id)->count();
                    $all = DB::table('history_friends')->where('groups_id','=',$id)->count();
                    
                @endphp
                <h5 class="my-2"> Member Available : <br>@php echo $count; @endphp</h5>
                <h5 class="my-2"> Members who have logged in : <br> @php echo $all; @endphp</h5>
                <h5 class="my-2"> outgoing member : <br>@php echo $all - $count; @endphp </h5>
              </div>
            </div>
          </div>
        </div>
    </div>
</section> 


    
    
    
@endsection


