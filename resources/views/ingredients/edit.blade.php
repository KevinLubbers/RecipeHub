@extends('main')

@section('content')
    
    <form method="POST" name="ingredientEdit" action="{{route('ingredients.update', $record->id)}}">
        @method('PUT')
        @csrf
        <h2>Edit Ingredient</h2>
        @include('flashmsgs.msgs')
        
        <div>
            @include('ingredients.form')

            <a href="{{route('recipes.edit', $record->recipe_id)}}"><button type="button" class="btn btn-outline-danger" name="submit">Back</button></a>
            <button type="submit" class="btn btn-outline-secondary" name="submit">Edit Ingredient</button>
        </div>

        <div id="output"></div>
    </form>

@endsection 