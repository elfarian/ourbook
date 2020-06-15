@php
    $yosa= $items->post_photo;
    $yosa = $yosa->SortByDesc('id');
@endphp
@extends('layouts.profile')
@section('title')
{{ $items->username }} Ourbook photos
@endsection
@section('content')

<section>
    <div class="row justify-content-center my-1">
        <div class="btn col-sm border-top mx-0 point-to">
            <a href="{{ route('profile', $items->username) }}" class="btn border-info btn-upload border mx-0 active">Photo</a>
            <a href="{{ route('statusprofile', $items->username) }}" class="btn btn-upload border mx-0">Status</a>
        </div>
    </div>
</section>

<!--isi gambar di profile-->
<main class="border-top isifotonya">
    <div class="container p-0 pt-3">
    <div class="row p-0 justify-content-md-left">

        
        @forelse ($yosa as $item)
        <div class="card col-4 m-0 px-0 text-center border kotakgambar d-flex flex-column" style="background-image: url('{{ Storage::url($item->post_photo) }}');">

         </div>   
        @empty

        <div class="col-sm border text-center isistatus mb-4">
            <div>
                <h3 class="py-4 text-center">Belum ada Foto</h3>
            </div>
        </div>
            
        @endforelse
        
        
    </div>
    </div>
</main>

@endsection