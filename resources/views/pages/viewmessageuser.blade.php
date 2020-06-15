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
                <div class="card-header msg_head border-dark border-bottom">
                    <div class="d-flex bd-highlight">
                        @foreach ($foto_user_yang_chat as $item)
                        <div class="img_cont">
                            @if ($item->image_profile != "")
                            <img src="{{ Storage::url($item->image_profile)}}" class="rounded-circle user_img">
                            @else
                            <img src="{{ url('frontend/images/photo_profile.png') }}" class="rounded-circle user_img">   
                            @endif
                        </div>
                        <div class="user_info">
                             <span>{{$item->name}}</span>
                        </div>
                        @endforeach
                        
                    </div>
                    <span id="action_menu_btn"></span>
                    <div class="action_menu">
                        
                    </div>
                </div>
                <div class="card-body msg_card_body">
                    @foreach ($isi_chat as $item)
                    @if ($item->users_id == Auth::user()->id)
                        <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            {{$item->chat}}
                            <span class="msg_time_send">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                        </div>
                        <div class="img_cont_msg">
                            @forelse ($untuk_foto_profile->photo_profile as $itemz)
                            <img src="{{ Storage::url($itemz->image_profile)}}" class="rounded-circle user_img_msg">
                            @empty
                            <img src="{{ url('frontend/images/photo_profile.png') }}" class="rounded-circle user_img_msg">
                            @endforelse        
                        </div>
                    </div>
                    @else
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            @foreach ($foto_user_yang_chat as $itemk)
                            @if ($itemk->image_profile != "")
                            <img src="{{ Storage::url($itemk->image_profile)}}" class="rounded-circle user_img_msg">
                            @else
                            <img src="{{ url('frontend/images/photo_profile.png') }}" class="rounded-circle user_img_msg">   
                            @endif
                            @endforeach
                        </div>
                        <div class="msg_cotainer">
                            {{$item->chat}}
                            <span class="msg_time">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                        
                    @endif
                        
                    @endforeach
                    
                </div>
                <div class="card-footer">
                    @foreach ($foto_user_yang_chat as $iteml)
                    <form action="{{ route('sendchat', [Auth::user()->id,$iteml->id]) }}" method="post">
                    @endforeach
                    @csrf
                    <div class="input-group">
                        <textarea name="chat" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <span class="input-group-text send_btn">
                                 <button type="submit" class="input-group-text"><i class="fas fa-location-arrow"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection