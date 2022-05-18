@extends('layouts.index')

@section('title', 'Coba')

@section('content')
<section id="show" class="about">
    <div class="container">
  
      <div class="section-title">
        <h2 class="mt-5">Friends</h2>
        <h3>Detail <span>Friends</span></h3>
        
      </div>
      <div class="row content">
          <div class="d-flex flex-wrap justify-content-center">
              <div class="card m-3 border-danger" style="width: 20rem;">
                <div class="card-body">
                    {{-- menampilkan data berdasarkan id --}}
                    {{-- tampil nama --}}
                    <h3 class="card-title m-3 text-danger">{{ $friends['nama'] }}</h3>
                    {{-- tampil no tlp  --}}
                    <h6 class="card-subtitle m-3 text-muted">No Tlp : {{ $friends['no_tlp'] }}</h6>
                    {{-- tampil alamat  --}}
                    <p class="card-text m-3"><b>Address :</b> {{ $friends['alamat'] }}</p>
                    {{-- tampil groups  --}}
                    <p class="card-text m-3"><b>group :</b>  
                      @php
                          if($friends->groups_id == 0){
                            echo 'Tidak dalam group';
                          }else{
                            echo $friends->groups->name;
                          }
                      @endphp
                      
                    </p>
                    {{-- tampil history groups --}}
                    <p class="card-text mx-3"><b>history group :</b> 
                      @foreach ($hfriends as $item)
                      @php
                          if($item->groups_id == 0){
                            echo '';
                          }else{
                            echo $item->history_groups->name.'->';
                          }
                      @endphp
                      {{-- {{ $item->groups->name }}/ --}}
                      @endforeach
                    </p>
                    
                    <p class="mx-3">
                      
                    </p>
                </div>
                {{-- tombol back  --}}
                <a class="btn btn-outline-primary" href="/#about" role="button">Back</a>
                
            </div>
          </div>
        </div>
    </div>
</section> 

    
    
@endsection


