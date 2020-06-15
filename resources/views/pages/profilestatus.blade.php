@php
    $yosa= $items->status;
    $yosa = $yosa->SortByDesc('id');
@endphp
@extends('layouts.profile')
@section('title')
{{ $items->username }} Ourbook Status
@endsection
@section('content')

<section>
    <div class="row justify-content-center my-1">
        <div class="btn col-sm border-top mx-0 point-to">
            <a href="{{ route('profile', $items->username) }}" class="btn btn-upload border mx-0">Photo</a>
            <a href="{{ route('statusprofile', $items->username) }}" class="border-info btn btn-upload border mx-0 active">Status</a>
        </div>
    </div>
</section>

<!--isi gambar di profile-->
<div class="container">
    <div class="row border-top">

        @forelse ($yosa as $itemr)
        @auth
        @if ($items->username == Auth::user()->username)
        <div class="col-12 border isistatus mb-4 table-responsive pt-2">
            <div>
                <table class="p-0 m-0">
                    <thead>
                        <tr>
                            <th class="align-top">
                                @forelse ($items->photo_profile as $itemz)
                                <img class="foto-status rounded-circle border" src="{{ Storage::url($itemz->image_profile)}}" alt="">   
                                @empty
                                <img class="foto-status rounded-circle border" src="{{ url('frontend/images/photo_profile.png') }}" alt="">       
                                @endforelse
                                    <td>
                                    <table class="col-sm">
                                        <tr>
                                            <th>
                                                {{ $items->name }} . <a href="{{ route('profile', $items->username)}}" class="font-weight-lighter"> @ {{ $items->username}}</a>
                                            </th>
                                            <td class="text-right">
                                            <a href="{{ route('editstatus', [$items->username, $itemr->id])}}" class="btn btn-info py-0"> edit </a>
                                            </td>
                                            <td class="text-right">
                                                <form action="{{ route('deletestatus', [$items->username, $itemr->id]) }}" method="post" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger py-0">
                                                    Delete
                                                    </button>
                                                    </form>
                                            </td> 
                                         </tr>
                                         <tr>
                                             <td>
                                                <p class="ket-waktu mt-0">
                                                    @if ($itemr->created_at == $itemr->updated_at)
                                                    Posted at: {{ \Carbon\Carbon::parse($itemr->created_at)->diffForHumans() }}
                                                    @else
                                                    Updated at: {{ \Carbon\Carbon::parse($itemr->updated_at)->diffForHumans() }}
                                                    @endif
                                                </p>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td colspan="2">
                                                 {{ $itemr->status }}
                                             </td>
                                         </tr>
                                    </table>
                                </td>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> 
        @else
        <div class="col-12 border isistatus mb-4 table-responsive">
            <div>
                <table class="p-0 m-0">
                    <thead>
                        <tr>
                            <th class="align-top">
                                @forelse ($items->photo_profile as $item)
                                <img class="foto-status rounded-circle border" src="{{ Storage::url($item->image_profile)}}" alt="">   
                                @empty
                                <img class="foto-status rounded-circle border" src="{{ url('frontend/images/photo_profile.png') }}" alt="">       
                                @endforelse
                                    <td>
                                    <table class="col-sm">
                                        <tr>
                                            <th>
                                            {{ $items->name }} . <a href="{{ route('profile', $items->username)}}" class="font-weight-lighter"> @ {{ $items->username}}</a>
                                            </th>
                                         </tr>
                                         <tr>
                                             <td>
                                                <p class="ket-waktu mt-0">
                                                    @if ($itemr->created_at == $itemr->updated_at)
                                                    Posted at: {{ \Carbon\Carbon::parse($itemr->created_at)->diffForHumans() }}
                                                    @else
                                                    Updated at: {{ \Carbon\Carbon::parse($itemr->updated_at)->diffForHumans() }}
                                                    @endif
                                                </p>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td colspan="2">
                                                 {{ $itemr->status }}
                                             </td>
                                         </tr>
                                    </table>
                                </td>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> 
        @endif
        @endauth
     @guest
        <div class="col-12 border isistatus mb-4 table-responsive">
            <div>
                <table class="p-0 m-0">
                    <thead>
                        <tr>
                            <th class="align-top">
                                @forelse ($items->photo_profile as $item)
                                <img class="foto-status rounded-circle border" src="{{ Storage::url($item->image_profile)}}" alt="">   
                                @empty
                                <img class="foto-status rounded-circle border" src="{{ url('frontend/images/photo_profile.png') }}" alt="">       
                                @endforelse
                                    <td>
                                    <table class="col-sm">
                                        <tr>
                                            <th>
                                                {{ $items->name }} . <a href="{{ route('profile', $items->username)}}" class="font-weight-lighter"> @ {{ $items->username}}</a>
                                            </th>
                                         </tr>
                                         <tr>
                                             <td>
                                                <p class="ket-waktu mt-0">
                                                    @if ($itemr->created_at == $itemr->updated_at)
                                                    Posted at: {{ \Carbon\Carbon::parse($itemr->created_at)->diffForHumans() }}
                                                    @else
                                                    Updated at: {{ \Carbon\Carbon::parse($itemr->updated_at)->diffForHumans() }}
                                                    @endif
                                                </p>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td colspan="2">
                                                 {{ $itemr->status }}
                                             </td>
                                         </tr>
                                    </table>
                                </td>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>    
    @endguest

        @empty
        <div class="col-sm border text-center isistatus mb-4">
            <div>
                <h3 class="py-4 text-center">Belum ada Status</h3>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection