@extends('main')

@section('content')
    <h3 style="margin-top:15px;">User Profile - {{$user->name}}</h3>
    <div>
       @include('flashmsgs.msgs') 
        <div style="margin-top:15px;" class="container">
            <div style="background-color:#f8f9fa;;" class="row">
                <div class="col-12" style="border:2px solid #ced4da;padding:15px;">
                    <b>Change Username:</b>
                </div>
                <div class="col-3" style="border:2px solid #ced4da;padding:15px;">
                    <div style="margin-bottom:5px;text-decoration:underline;">Current Username:</div>
                    <div>
                        <input class="form-control me-1" type="text" value="{{$user->name}}" name="showUser" tabindex="-1" readonly>
                    </div>
                </div>
                <div class="col-9" style="border:2px solid #ced4da;padding:15px;">
                    <form name="updateName" action="{{route('profile.user')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div style="margin-bottom:5px;text-decoration:underline;">New Username:</div>
                    
                        <input style="width:85%;float:left;"class="form-control me-1" type="text" name="name" autofocus>
                        <button style="float:right;" type="submit" class="btn btn-primary">Update</button>
                    </form> 
                </div>
            </div>
        </div>

        <div style="margin-top:15px;" class="container">
            <div style="background-color:#f8f9fa;;" class="row">
                <div class="col-12" style="border:2px solid #ced4da;padding:15px;">
                    <b>Change Password:</b>
                </div>
                <div class="col-3" style="border:2px solid #ced4da;padding:15px;">
                    <div style="margin-bottom:5px;text-decoration:underline;">Current Password:</div>
                    <div>
                        <input class="form-control me-1" type="text" value="**************" name="showPassword" tabindex="-1" readonly>
                    </div>
                </div>
                <div class="col-9" style="border:2px solid #ced4da;padding:15px;">
                    <form name="updatePassword" action="{{route('profile.password')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div style="margin-bottom:5px;text-decoration:underline;">New Password:</div>
                        <input style="width:85%;"class="form-control me-1" type="password" name="password"> 
                        <div style="margin-bottom:5px;text-decoration:underline;">Repeat Password:</div>
                        <div>
                        <input style="float:left;width:85%;"class="form-control me-1" type="password" name="repeat">
                        <button style="float:right;" type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div style="margin-top:15px;" class="container">
            <div style="background-color:#f8f9fa;;" class="row">
                <div class="col-12" style="border:2px solid #ced4da;padding:15px;">
                    <b>Change Email:</b>
                </div>
                <div class="col-3" style="border:2px solid #ced4da;padding:15px;">
                    <div style="margin-bottom:5px;text-decoration:underline;">Current Email:</div>
                    <div>
                        <input class="form-control me-1" type="text" value="{{$user->email}}" name="showEmail" tabindex="-1" readonly>
                    </div>
                </div> 
                <div class="col-9" style="border:2px solid #ced4da;padding:15px;">
                    <form name="updateEmail" action="{{route('profile.email')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div style="margin-bottom:5px;text-decoration:underline;">New Email:</div>
                        <input style="width:85%;float:left;"class="form-control me-1" type="text" name="email" >
                        <button style="float:right;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div style="margin-top:15px;" class="container">
            <div style="background-color:#f8f9fa;;" class="row">
                <div class="col-12" style="border:2px solid #ced4da;padding:15px;">
                    <b>Account Actions:</b>
                </div>
                <div class="col-3" style="border:2px solid #ced4da;padding:15px;">
                    <div>
                        <div style="margin-bottom:5px;text-decoration:underline;">Verify Email:</div>
                        This action will send a verification email to your account's email address. Click the link inside to verify.
                    </div>
                </div>
                <div class="col-3" style="border:2px solid #ced4da;padding:15px;">
                    <button style="float:right;" type="button" class="btn btn-success">Verify</button>
                </div>
                <div class="col-3" style="border:2px solid #ced4da;padding:15px;">
                    <div>
                        <div style="margin-bottom:5px;text-decoration:underline;">Delete Account:</div>
                        This action will delete your account as well as all of your recipes. Are you sure you want to continue?
                    </div>
                </div>
                <div class="col-3" style="border:2px solid #ced4da;padding:15px;">
                    <form name="deleteAccount" action="{{route('profile.destroy')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style="float:right;" type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    

    
@endsection

@section('scripts')


@endsection