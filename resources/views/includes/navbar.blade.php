
<div class="container">
    <div class="row row-cols">
        <nav class="col navbar navbar-expand-lg navbar-expand-md fixed-top navbar-light bg-white border-top-0 pb-0">
            <a href="{{ route('dashboard')}}" class="navbar-brand ml-2">
                <img src="{{ url('frontend/images/icon_projek.png') }}" class="d-none d-sm-block"  alt="Logo">
            </a>

            <form action="{{ route('search') }}" method="get" class="col form-inline search-collapse navbar-search" id="searchDropdown">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="search..." aria-label="search" aria-describedby="basic-addon2">
                  <div class="input-group-prepend">
                    <button type="submit" class="input-group-text search-logos"><i class="fas fa-search fa-sm"></i></button>
                  </div>
                </div>
              </form>

            <button class="navbar-toggler navbar-toggler-right "
            type="button"
            data-toggle="collapse"
            data-target="#navb"
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            @auth
                
           <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item mx-md-0 px-0">
                        <a href="{{ route('profile', Auth::user()->username) }}" class="nav-link btn">
                            @forelse ($untuk_foto_profile->photo_profile as $item)
                            <img class="profile-photo-nav mr-1 rounded-circle" src="{{ Storage::url($item->image_profile)}}" alt="">
                            @empty
                            <img class="profile-photo-nav mr-1 rounded-circle" src="{{ url('frontend/images/photo_profile.png') }}" alt="">
                            @endforelse   
                            {{ Auth::user()->username }}
                        </a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="{{ route('dashboard') }}" class="nav-link btn ">
                            Home
                        </a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="{{ route('viewchat', Auth::user()->username) }}" class="nav-link btn ">
                            My Chat 
                            @if ($count_message > 0)
                            <span class="bg-danger border border-danger m-0 notif rounded-0">{{$count_message}}</span> 
                            @endif
                            
                        </a>
                        
                    </li>
                    
                    <li class="nav-item dropdown btn">
                        <a href="" class="nav-link mx-md-2 dropdown-toggle" id="navbardrop"
                        data-toggle="dropdown">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{Route('setting')}}" class="dropdown-item"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Setting</a>
                            <form action="{{ url('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</button>
                            </form>                            
                        </div>
                    </li>
                </ul>
           </div>

           @endauth

           @guest
           <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3 mb-1">
                <li class="nav-item mx-md-2">
                    <button class="nav-link btn mx-1 px-2 border aktif"
                    onclick="event.preventDefault(); location.href='{{ url('login')}}'">
                        Login
                    </button>
                </li>
                <li class="nav-item mx-md-0 px-0">
                    <button href="#" class="nav-link btn mx-1 px-2"
                    onclick="event.preventDefault(); location.href='{{ url('register')}}'">
                        Register
                    </button>
                </li>
            </ul>
            </div>
           @endguest
        </nav>
    </div>
</div>