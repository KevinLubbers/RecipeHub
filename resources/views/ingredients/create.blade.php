@extends('main')

@section('content')
    
    <form method="POST" name="ingredientCreate" action="{{route('ingredients.store')}}">
        @csrf
        <h2>Create Ingredient</h2>
        @include('flashmsgs.msgs')
        
        <div>
            @include('ingredients.createForm')

            <a href="{{route('recipes.edit', $sentID)}}"><button type="button" class="btn btn-outline-danger" name="submit">Back</button></a>
            <button type="submit" class="btn btn-outline-secondary" name="submit">Create Ingredient</button>
        </div>

        <div id="output"></div>
    </form>

@endsection 