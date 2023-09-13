@extends('main')

@section('content')
    
    @if(isset($show))
        <h4>Recipe # {{$show->id}} : {{$show->title}}</h4>
    @endif
@endsection