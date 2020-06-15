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
                <form action="{{ route('updatestatus', [Auth::user()->username, $item->id]) }}" method="post">
                   
                    @csrf
                    <div class="form-group">
                        <label for="judul"><h3>Edit Status</h3></label>
                    </div>
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" readonly class="form-control-plaintext" name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="type_status">Type Status</label>
                        <select name="type_status" required class="form-control">
                                <option value="{{ $item->type_status }}">*Jangan Diubah({{$item->type_status}})</option>
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
                        <textarea name="status" rows="10" class="d-block w-100 form-control">{{ $item->status }}</textarea>
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