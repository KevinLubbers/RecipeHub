@extends('main')

@section('content')
    
    <form method="POST" action="{{route('login.store')}}">
        @csrf
        <h2>Log In</h2>
        @include('flashmsgs.msgs')
        <div>
            <input type="email" class="form-control" style="width:50%;margin-top:5px;margin-bottom:5px;" name="email" id="email" placeholder="Enter Email Address" value="{{old('email')}}" {{old('email')  ? '' : 'autofocus'}} required />
            <input type="password" class="form-control" style="width:50%;margin-top:5px;margin-bottom:5px;" name="password" id="password" placeholder="Enter Password" {{old('email')  ? 'autofocus' : ''}} required/>
            
            <button type="submit" class="btn btn-dark" >Log In</button>
        </div>
        <div id="output"></div>
    </form>

@endsection