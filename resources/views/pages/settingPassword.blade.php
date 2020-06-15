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
                            @if (session('error'))
                            <div class="alert alert-danger">
                            {{ session('error') }}
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success">
                            {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{ Route('changePassword')}}" method="post">
                                @csrf
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>
                                <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>
                                
                                @if ($errors->has('current-password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                                @endif
                                </div>
                                </div>

                                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>
                                    <div class="col-md-6">
                                        <input id="new-password" type="password" class="form-control" name="new-password" required>
                                
                                @if ($errors->has('new-password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                                @endif
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                                
                                <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password-confirm" required>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                Change Password
                                </button>
                                </div>
                                </div>
                                </form>
                        </div>
                    </div>                          
            </div>
        </div>
    </div>
</div>
@endsection