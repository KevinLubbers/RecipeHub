@extends('main')

@section('content')
    
    <form method="POST" action="{{route('register.store')}}">
        @csrf
        <h2>Register</h2>
        @include('flashmsgs.msgs')
        <div>
            <input type="text" class="form-control" style="width:50%;margin-top:5px;margin-bottom:5px;" name="name" id="name" placeholder="Enter Username" value="{{old('name')}}" required autofocus/>
            <input type="email" class="form-control" style="width:50%;margin-top:5px;margin-bottom:5px;" name="email" id="email" placeholder="Enter Email Address" value="{{old('email')}}" required/>
            <input type="password" class="form-control" style="width:50%;margin-top:5px;margin-bottom:5px;" name="password" id="password" placeholder="Enter Password" required/>
            
            <button type="submit" class="btn btn-dark" >Register</button>
        </div>
        <div id="output"></div>
    </form>

@endsection