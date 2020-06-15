@extends('layouts.home')
@section('title')
Ourbook
@endsection
@section('content')

<div class="col mb-3 status-beranda">

    <div class="info-beranda mx-auto row row-cols-4 justify-content-center">
        <a class="btn btn-upload col btn-sm align-self-center mx-1 active" href="#">Photos</a>
        <a class="btn btn-upload col btn-sm align-self-center mx-1" href="{{Route('status')}}">Status</a>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger mt-2">
    <ul>
        @foreach ($errors->all() as $errors)
            <li>{{ $errors }}</li>
        @endforeach    
    </ul>    
    </div>        
    @endif
    <div class="d-block d-sm-block d-md-none">
    <div class="row row-cols-8 m-3 justify-content-center">
    <button type="button" class="rounded-pill btn btn-upload align-self-center p-1" data-toggle="modal" data-target="#modalBanner">
       + photos
    </button> 
    </div>
    </div>
    @forelse ($fotos as $item)
    <div class="rounded sidebar-item-1 status-item">
        <table>
            <thead>
                <th>
                    @if ($item->image_profile != '')                  
                    <a href="{{ Route('profile', $item->username) }}"><img class="profile-suggest mx-2 my-2 rounded-circle" src="{{ Storage::url($item->image_profile) }}" alt="">  {{$item->username}}</a> 
                    @else
                    <a href="{{ Route('profile', $item->username) }}"><img class="profile-suggest mx-2 my-2 rounded-circle" src="{{ url('frontend/images/photo_profile.png') }}" alt="">  {{$item->username}}</a> 
                    @endif
                    @if (Auth::user()->id == $item->users_id)
                    <form action="{{ route('deletephoto', [$item->username, $item->id]) }}" method="post" class="d-inline">
                        @csrf
                        <button class="btn btn-danger py-0">
                        Delete
                        </button>
                        </form>                    
                    @endif   
                                              
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                       <img class="img-fluid" src="{{ Storage::url($item->post_photo) }}" alt="">
                    </td>
                </tr>
                
                <tr>
                    <!--<td class="count-likes p-0 ml-2 btn">
                        108 likes
                    </td> -->
                </tr>
                <tr>
                    <td>
                       <p class="mx-1 ket-321">
                           {{$item->caption}}
                       </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="ket-waktu mx-1">
                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>  
        </div>
    </div> 
    @empty
    <div class="rounded sidebar-item-1 status-item align-self-center mx-auto">
        <p class="text-center p-2">No Photos</p>
        </div>
    @endforelse
</div>
@endsection