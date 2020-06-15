@extends('layouts.home')
@section('title')
Ourbook
@endsection
@section('content')


<div class="col mb-3 status-beranda">
    <div class="info-beranda mx-auto row row-cols-4 justify-content-center">
        <a class="btn btn-upload col btn-sm align-self-center mx-1">Searching for "{{ $searchtoken}}"</a>
    </div>
    @forelse ($search as $item)
    <div class="rounded sidebar-item-1 status-item">
        <table>
            <thead>
                <th>
                    <tr>
                    @if ($item->image_profile != '')                  
                    <a href="{{ Route('profile', $item->username) }}"><img class="profile-suggest border mx-2 my-2 rounded-circle foto-profile" src="{{ Storage::url($item->image_profile) }}" alt=""> {{$item->username}}</a> 
                    @else
                    <a href="{{ Route('profile', $item->username) }}"><img class="profile-suggest border mx-2 my-2 rounded-circle foto-profile" src="{{ url('frontend/images/photo_profile.png') }}" alt="">{{$item->username}}</a> 
                    @endif
                </tr>
                    <tr>
                        <p class="mx-1 ket-321">
                           <h6 class="ml-1 p-0">{{$item->name}}</h6>
                        </p>
                     </tr>
            </thead>
        </table>
        <div>
                
        </div>
    
    </div> 
    @empty
    <div class="rounded sidebar-item-1 status-item align-self-center mx-auto">
        <p class="text-center p-2">No Result</p>
        </div>
    @endforelse
</div>
@endsection