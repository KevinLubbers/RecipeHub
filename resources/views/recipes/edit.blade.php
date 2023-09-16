@extends('main')

@section('content')
    
    <form method="POST" name="recipeEdit" action="{{route('recipes.update', $record->id)}}">
        @method('PUT')
        @csrf
        <h2>Edit Recipe</h2>
        <div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Recipe Name:</label>
                <input type="text" class="form-control" id="title" name="recipe_title" value="{{$record->title}}" style="width:50%;" autofocus required>
              </div>
            <a href="{{route('recipes.index')}}"><button type="button" class="btn btn-outline-danger" name="submit">Back</button></a>
            <button type="submit" class="btn btn-outline-secondary" name="submit">Edit Recipe Name</button>
        </div>
        <div id="output"></div>
    </form>

    

    @include('ingredients.index')

@endsection 