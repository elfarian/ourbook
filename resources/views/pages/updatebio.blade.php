@extends('layouts.upload')
@section('title')
Ourbook
@endsection
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
                    
                    <form action="{{ route('updatebio_run', [Auth::user()->username]) }}" method="post">
                   
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
                        @forelse ($items->bio as $item)
                        <textarea name="bio" rows="10" class="d-block w-100 form-control">{{ $item->bio }}</textarea> 
                        @empty
                        <textarea name="bio" rows="10" class="d-block w-100 form-control"></textarea> 
                        @endforelse
                        
                        
                    </div>
                    <div class="form-group">
                        <label for="web">Website</label>
                        <input type="text" class="form-control" name="web" placeholder="Your Website" 
                        @foreach ($items->bio as $item)
                        value="{{ $item->web}}">
                        @endforeach
                    </div> 

                    <button type="submit" class="btn btn-primary btn-block">
                        Update
                    </button>
                </form>
            </div>
        </div>  
    </div>
</div>
@endsection