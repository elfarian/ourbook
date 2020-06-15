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
                <form action="{{ route('sendstatus') }}" method="post">
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
                        <textarea name="status" rows="10" class="d-block w-100 form-control">{{ old('status')}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Post
                    </button>
                </form>
            </div>
        </div>

        
    </div>
</div>
@endsection