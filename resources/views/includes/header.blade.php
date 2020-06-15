@php
    $bioku = $items->bio;
@endphp
@auth
@forelse ($untuk_banner_profile->banner_profile as $item)

<header  style="background-image: url('{{ Storage::url($item->banner_profile)}}');">
@if ($items->username == Auth::user()->username)
<button type="button" class="btn btn-info p-0 mt-3 btn-banner ml-2 px-2" data-toggle="modal" data-target="#modalBanner">
    Change Banner
 </button> 
 <div class="modal fade" id="modalBanner" tabindex="-1" role="dialog" aria-labelledby="modalBannerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalBannerLabel">Change Banner Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                @endforeach    
            </ul>    
            </div>        
            @endif
          <form action="{{ route('updatebanner', [Auth::user()->username, $item->id])}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                  <input type="file" class="form-control py-1" name="banner_profile" placeholder="Image">
              </div>
              <button type="submit" class="btn btn-primary btn-block">
                  Update
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Oke</button>
        </div>
      </div>
    </div>
  </div>  

@endif
@empty
<header  style="background-image: url('{{ url('frontend/images/banner.png') }}');">
@if ($items->username == Auth::user()->username)
<button type="button" class="btn btn-info p-0 mt-3 btn-banner ml-2 px-2" data-toggle="modal" data-target="#modalBanner">
    + Add Banner
 </button> 
 <div class="modal fade" id="modalBanner" tabindex="-1" role="dialog" aria-labelledby="modalBannerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalBannerLabel">Change Banner Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $errors)
                                <li>{{ $errors }}</li>
                            @endforeach    
                        </ul>    
                        </div>        
                    @endif
          <form action="{{ route('uploadbanner', Auth::user()->username)}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                  <input type="file" class="form-control py-1" name="banner_profile" placeholder="Image">
              </div>
              <button type="submit" class="btn btn-primary btn-block">
                  Upload
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Oke</button>
        </div>
      </div>
    </div>
  </div>  

@endif
@endforelse
    <div class="container">
        <div class="row justify-content-center">
            <div class="col myprofile">
                <div class="text-center col-12" style="color: white;">
                    @forelse ($items->photo_profile as $item)
                    <img class="rounded-circle border foto-profile" src="{{ Storage::url($item->image_profile)}}" alt="">  
                    <br>
                    @if ($items->username == Auth::user()->username)
                    <button type="button" class="btn btn-info p-0 mt-1" data-toggle="modal" data-target="#modalSaya">
                        Change Photo
                     </button> 
                     <div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalSayaLabel">Change Photo Profile</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                     @if ($errors->any())
                                        <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $errors)
                                                <li>{{ $errors }}</li>
                                            @endforeach    
                                        </ul>    
                                        </div>        
                                    @endif
                              <form action="{{ route('updatephoto', [Auth::user()->username, $item->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                  <div class="form-group">
                                      <input type="file" class="form-control py-1" name="image_profile" placeholder="Image">
                                  </div>
                                  <button type="submit" class="btn btn-primary btn-block">
                                      Upload
                                  </button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary">Oke</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                   
                    @empty
                    <img class="rounded-circle border foto-profile" src="{{ url('frontend/images/photo_profile.png') }}" alt="">  
                    <br>
                    @if ($items->username == Auth::user()->username)
                    <button type="button" class="btn btn-info p-0 mt-1" data-toggle="modal" data-target="#modalSaya">
                        + Photo Profile
                     </button> 
                     <div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalSayaLabel">Upload Photo Profile</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                     @if ($errors->any())
                                        <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $errors)
                                                <li>{{ $errors }}</li>
                                            @endforeach    
                                        </ul>    
                                        </div>        
                                    @endif
                              <form action="{{ route('uploadphoto', Auth::user()->username)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                  <div class="form-group">
                                      <input type="file" class="form-control py-1" name="image_profile" placeholder="Image">
                                  </div>
                                  <button type="submit" class="btn btn-primary btn-block">
                                      Upload
                                  </button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary">Oke</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                
              

                      @endif
                    
                    @endforelse
                    
                    <h2>{{ $items->name }}</h2>
                    <h3>@
                    {{$items->username }}</h3>

                    @forelse ($items->bio as $item)
                    <div>
                    <p class="font-weight-normal" style="color: #E8E7E7; margin-bottom: 0;">{{ $item->bio }}</p>
                    <a target="_blank"  href="<?php echo $item['web']; ?>">{{ $item->web }}</a>
                    </div>
                    @if ($items->username == Auth::user()->username) 
                    <a href="{{ route('updatebio', [Auth::user()->username])  }}" class="btn btn-edit-profile mt-2 mb-0">Edit Profile</a> 
                    @endif
                    @empty
                    @if ($items->username == Auth::user()->username) 
                    <a href="{{ route('createbio', [Auth::user()->username])  }}" class="btn btn-edit-profile mt-2 mb-0">Make bio Profile</a> 
                    @endif
                    @endforelse
                            
                    @if ($items->username != Auth::user()->username) 
                    <a href="{{ route('viewchatuser', [Auth::user()->username, $items->id]) }}" class="btn btn-edit-profile mt-2 mb-0">Message</a>
                   @forelse ($cekfollow as $itemzz)
                    <a href="{{ route('unfollowuser', $items->id)}}" class="btn btn-edit-profile mt-2 mb-0">UnFollow</a>  
                    @empty
                    <a href="{{ route('followuser', $items->id) }}" class="btn btn-edit-profile mt-2 mb-0">Follow</a> 
                    @endforelse             
                    
                    @endif
                </div>   
            </div>
        </div>
    </div>
</header>
@endauth

@guest
@forelse ($untuk_banner_profile->banner_profile as $item)
<header  style="background-image: url('{{ Storage::url($item->banner_profile)}}');">
@empty
<header  style="background-image: url('{{ url('frontend/images/banner.png') }}');">
@endforelse
    <div class="container">
        <div class="row justify-content-center">
            <div class="col myprofile">
                <div class="text-center col-12 box-profile" style="color: white;">
                    @forelse ($items->photo_profile as $item)
                     <img class="rounded-circle border foto-profile" src="{{ Storage::url($item->image_profile)}}" alt="">   
                    @empty
                    <img class="rounded-circle border foto-profile" src="{{ url('frontend/images/photo_profile.png') }}" alt="">  
                    @endforelse
                    <h2>{{ $items->name }}</h2>
                    <h3>@
                    {{$items->username }}</h3>
                    @forelse ($items->bio as $item)
                    <p class="font-weight-normal" style="color: #E8E7E7; margin-bottom: 0;">{{ $item->bio }}</p>
                    <a target="_blank"  href="">{{ $item->web }}</a>
                    @empty
                    @endforelse
                </div>   
            </div>
        </div>
    </div>
</header>
@endguest



<section class="mb-2">
    <div class="row justify-content-center my-1">
        <div class="btn col-2 border border-info mx-2 d-none d-sm-block">{{ $count_photo }} Photos</div>
        <div class="btn col-2 border mx-2 border-info d-none d-sm-block"> {{ $count_status }} Posts</div>
        <button type="button" class="border-info col-2 jumlahfollowers btn btn-upload d-none d-sm-block" data-toggle="modal" data-target="#modalfollowers">{{ $count_followers}} Followers</button> 
        <button type="button" class="border-info col-2 btn btn-upload border mx-2 d-none d-sm-block" data-toggle="modal" data-target="#modalfollowing">{{ $count_following }} Following</button>
    </div>

    <div class="row justify-content-center my-1">
      <div class="btn col-6 d-block d-sm-none">{{ $count_photo }} Photos</div>
      <div class="btn col-6 d-block d-sm-none"> {{ $count_status }} Posts</div>
      <button type="button" class="col-6 jumlahfollowers border-0 btn btn-upload d-block d-sm-none" data-toggle="modal" data-target="#modalfollowers">{{ $count_followers}} Followers</button> 
      <button type="button" class="col-6 btn btn-upload border-0 d-block d-sm-none" data-toggle="modal" data-target="#modalfollowing">{{ $count_following }} Following</button>
  </div>
</section>


<div class="modal fade" id="modalfollowers" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStatusLabel">Followers {{$items->username}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <table>
          <tbody>
            @foreach ($followersnya as $item)
            <tr>
                @if ($item->image_profile != '')   
            <td><a href="{{ Route('profile', $item->username) }}"><img style="max-width: 100px; max-height: 100px;" class="profile-suggest border mx-2 my-2 rounded-circle foto-profile" src="{{ Storage::url($item->image_profile) }}" alt=""> {{$item->username}}</a> </td>
                @else
            <td><a href="{{ Route('profile', $item->username) }}"><img style="max-width: 100px; max-height: 100px;" class="profile-suggest border mx-2 my-2 rounded-circle foto-profile" src="{{ url('frontend/images/photo_profile.png') }}" alt="">{{$item->username}}</a> </td>   
                @endif
            </tr>
            @endforeach
        </tbody>
        </table>
       
        
      </div>
    </div>
  </div>
</div>  


<div class="modal fade" id="modalfollowing" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStatusLabel">Following by {{$items->username}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <table>
          <tbody>
            @foreach ($followingnya as $item)
            <tr>
                @if ($item->image_profile != '')   
            <td><a href="{{ Route('profile', $item->username) }}"><img style="max-width: 100px; max-height: 100px;" class="profile-suggest border mx-2 my-2 rounded-circle foto-profile" src="{{ Storage::url($item->image_profile) }}" alt=""> {{$item->username}}</a> </td>
                @else
            <td><a href="{{ Route('profile', $item->username) }}"><img style="max-width: 100px; max-height: 100px;" class="profile-suggest border mx-2 my-2 rounded-circle foto-profile" src="{{ url('frontend/images/photo_profile.png') }}" alt="">{{$item->username}}</a> </td>   
                @endif
            </tr>
            @endforeach
        </tbody>
        </table>
       
        
      </div>
    </div>
  </div>
</div>  
