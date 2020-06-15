@extends('layouts.upload')

@section('content')

<div class="container sidebar-item">
    <div class="row">

        <div class="card shadow col-sm">
            <div class="card-body">
                     @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $errors)
                                <li>{{ $errors }}</li>
                            @endforeach    
                        </ul>    
                        </div>  
                    @endif      
                    
                    <form action="{{ route('makebio', [Auth::user()->username, Auth::user()->id ]) }}" method="post">
                   
                    @csrf
                    <div class="form-group">
                        <label for="judul"><h3>Edit Your Bio Profile</h3></label>
                    </div>
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" readonly class="form-control-plaintext" name="name" value="{{ Auth::user()->name }}">
                    </div>                    
                    <div class="form-group">
                        <label for="bio">Your Bio</label>
                        <textarea name="bio" rows="10" class="d-block w-100 form-control">{{ old('bio') }}</textarea>
                        
                    </div>
                    <div class="form-group">
                        <label for="web">Website</label>
                        <input type="text" class="form-control" name="web" placeholder="Your Website" value="{{ old('web') }}">
                    </div> 

                    <button type="submit" class="btn btn-primary btn-block">
                        Edit
                    </button>
                </form>
            </div>
        </div>

        
    </div>
</div>


@endsection