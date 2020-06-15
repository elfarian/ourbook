@extends('layouts.home')
@section('title')
Ourbook
@endsection
@section('content')


<div class="col mb-3 status-beranda">

    <div class="info-beranda mx-auto row row-cols-4 justify-content-center">
    <a class="btn btn-upload col btn-sm align-self-center mx-1" href="{{ Route('dashboard')}}">Photos</a>
        <a class="btn btn-upload col btn-sm align-self-center mx-1 active" href="#">Status</a>
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
    <button type="button" class="rounded-pill btn btn-upload align-self-center p-1" data-toggle="modal" data-target="#modalStatus">
       + status
    </button> 
    </div>
    </div>
    @forelse ($status as $item)
    <div class="rounded sidebar-item-1 status-item">
        <table>
            <thead>
                <th>
                    @if ($item->image_profile != '')                  
                    <a href="{{ Route('profile', $item->username) }}"><img class="profile-suggest mx-2 my-2 rounded-circle" src="{{ Storage::url($item->image_profile) }}">  {{$item->username}}</a> 
                    @else
                    <a href="{{ Route('profile', $item->username) }}"><img class="profile-suggest mx-2 my-2 rounded-circle" src="{{ url('frontend/images/photo_profile.png') }}">  {{$item->username}}</a> 
                    @endif
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                       <p class="mx-1 ket-321">
                           {{$item->status}}
                       </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="ket-waktu mx-1">
                            @if ($item->updated_at != $item->created_at)
                            Updated at {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}   
                            @else
                            Created at {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                            @endif
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    
    </div> 
    @empty
    <div class="rounded sidebar-item-1 status-item align-self-center mx-auto">
    <p class="text-center p-2">No Status</p>
    </div>
    @endforelse
    
</div>
@endsection