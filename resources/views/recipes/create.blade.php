@extends('main')

@section('content')
    
    <form method="POST" name="recipeCreate" action="{{route('recipes.store')}}">
        @csrf
        <h2>Create New Recipe</h2>
        @include('flashmsgs.msgs')
        <div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Enter Recipe:</label>
                <input type="text" class="form-control" id="title" name="recipe_title" placeholder="Spaghetti and Meatballs" style="width:50%;" autofocus required>
              </div>
            
            <a href="{{route('recipes.index')}}"><button type="button" class="btn btn-outline-danger" name="submit">Back</button></a>  
            <button type="submit" class="btn btn-outline-secondary" name="submit">Create</button>
        </div>
        
        <div id="output"></div>
    </form>

@endsection 