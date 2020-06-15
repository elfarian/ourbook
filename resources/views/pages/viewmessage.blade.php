@extends('layouts.message')
@section('title')
Ourbook Chat
@endsection
@section('content')

<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="form-control-serch">Your Chat</span>
                    </div>
                </div>
            </div>
            <div class="card-body contacts_body">
                <ui class="contacts">
                
                    @forelse ($yang_chat as $item)
                    <a href="{{ route('viewchatuser', [Auth::user()->username, $item->id]) }}">
                        <li class="active btn">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    @if ($item->image_profile != "")
                                    <img src="{{ Storage::url($item->image_profile)}}" class="rounded-circle user_img">
                                    @else
                                    <img src="{{ url('frontend/images/photo_profile.png') }}" class="rounded-circle user_img">   
                                    @endif
                                </div>
                                <div class="user_info">
                                    <span>{{$item->username}}</span>
                                    @if ($item->count > 0)
                                    <span class="rounded bg-danger rounded-0 notif2 px-1 ml-auto">{{$item->count}}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </a>
                    <br>
                    @empty

                    <span class="m-3 badge badge-secondary text-wrap">No Chat</span>
                        
                    @endforelse
                
                </ui>
            </div>
            <div class="card-footer"></div>
        </div></div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                
            </div>
        </div>
    </div>
</div>
@endsection