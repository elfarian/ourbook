<div class="container">
 <div class="row">

<section class="d-none d-md-block col-4 sidebar-umum">
    <div class="fixed-top col-4">
    <div class="rounded sidebar-item" >
    <ul class="mr-1 navbar-nav bg-gradient-primary sidebar ml-3" id="accordionSidebar">
        <div class="sidebar-heading mt-3 mb-2">
            <table>
                <tbody>
                    <tr>
                        <td>
                            @forelse ($untuk_foto_profile->photo_profile as $item)
                            <a href="{{ route('profile', Auth::user()->username) }}"><img class="profile-sidebar ml-1 mb-2 rounded-circle" src="{{ Storage::url($item->image_profile)}}" alt=""></a>  
                            @empty
                            <a href="{{ route('profile', Auth::user()->username) }}"><img class="profile-sidebar ml-1 mb-2 rounded-circle" src="{{ url('frontend/images/photo_profile.png') }}" alt=""></a>  
                            @endforelse
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('profile',  Auth::user()->username) }}" class="btn text-left"> {{ Auth::user()->name }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-upload text-left" data-toggle="modal" data-target="#modalStatus">
                                Make Status
                            </button> 
                            <!-- <a href="{{ route('makestatus') }}" class="btn btn-upload text-left">Make Status</a> -->
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <button type="button" class="btn btn-upload text-left" data-toggle="modal" data-target="#modalBanner">
                             Post Photo
                             </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </ul>
    </div>
    <div class="rounded sidebar-item-1">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Suggestions For You</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($request as $itemr)
                <tr>
                    @if ($itemr->image_profile != '')   
                <td><a href="{{ Route('profile', $itemr->username) }}"><img class="profile-suggest rounded-circle mr-1" src="{{ Storage::url($itemr->image_profile) }}" alt="">{{ $itemr->username}}</a></td>
                    @else
                <td><a href="{{ Route('profile', $itemr->username) }}"><img class="profile-suggest rounded-circle mr-1" src="{{ url('frontend/images/photo_profile.png') }}" alt="">{{ $itemr->username}}</a></td>   
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="ml-2 justify-content-center align-items-center">
        <div class="border-top col-auto font-weight-light pt-3 footer">
            2020 Copyright OurBook • All rights reserved • Made in Surabaya
        </div>
    </div>
    </div>
</section>

<div>
    
</div>

<div class="modal fade" id="modalBanner" tabindex="-1" role="dialog" aria-labelledby="modalBannerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalBannerLabel">Post Photo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
           
          <form action="{{ route('postphoto', [Auth::user()->username])}}" method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                  <input type="file" class="form-control py-1" name="post_photo" placeholder="Image">
              </div>
              <div class="form-group">
                <label for="caption">Caption</label>
                <textarea name="caption" rows="5" class="d-block w-100 form-control">{{ old('caption')}}</textarea>
            </div>
              <button type="submit" class="btn btn-primary btn-block">
                  Upload
              </button>
          </form>
        </div>
      </div>
    </div>
  </div>  



  <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalStatusLabel">Make Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
           
          <form action="{{ route('sendstatus') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" readonly class="form-control-plaintext" name="name" value="{{ Auth::user()->name }}">
            </div>
            <div class="form-group">
                <label for="type_status">Type Status</label>
                <select name="type_status" required class="form-control">
                        <option value="PUBLIC">
                            PUBLIC
                        </option>
                        <option value="PRIVATE">
                            PRIVATE
                        </option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Your Feeling</label>
                <textarea name="status" rows="5" class="d-block w-100 form-control">{{ old('status')}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Post
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>  





