@extends('layouts.message')
@section('title')
Ourbook Setting
@endsection
@section('content')

<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="form-control-serch">Setting User</span>
                    </div>
                </div>
            </div>
            <div class="card-body contacts_body">
                <ui class="contacts">
                    <a href="{{Route('setting')}}">
                        <li class="active btn">
                            <div class="d-flex bd-highlight">
                                <div class="user_info">
                                    <span>Change Name</span>
                                </div>
                            </div>
                        </li>
                    </a>
                    <br>
                    <a href="{{Route('settingU')}}">
                        <li class="active btn">
                            <div class="d-flex bd-highlight">
                                <div class="user_info">
                                    <span>Change Username</span>
                                </div>
                            </div>
                        </li>
                    </a>
                    <br>
                   <a href="{{Route('settingP')}}">
                        <li class="active btn">
                            <div class="d-flex bd-highlight">
                                <div class="user_info">
                                    <span>Change Password</span>
                                </div>
                            </div>
                        </li>
                    </a>
                    <br>

                    
                        
                    
                
                </ui>
            </div>
            <div class="card-footer"></div>
        </div></div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                

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
                            <form action="{{ Route('settingName')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name1">Your Name Now</label>
                                    <input type="text" readonly class="form-control-plaintext" name="name1" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="type_status">Your New Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ Auth::user()->name }}" value="{{ old('name') }}">
                                </div>
            
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>                              
            </div>
        </div>
    </div>
</div>
@endsection