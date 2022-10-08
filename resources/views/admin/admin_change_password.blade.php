@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Change password Page</h4>
                            <br>
                        </div>
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger alert-dismissable fade show">{{$error}}</p>
                            @endforeach
                        @endif
                        <form action="{{route('update.password')}}" method="POST" >
                            @csrf
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="oldpassword" class="form-control" id="oldpassword" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="newpassword" class="form-control" id="newpassword" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" value="">
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-info  waves-effect waves-light">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection