@extends('main')

@section('content')
    <h1>All Recipes</h1>
    <a href="{{route('recipes.create')}}"><button type="button" class="btn btn-outline-primary" style="margin-bottom:20px;">Create New Recipe</button></a>
    @include('flashmsgs.msgs')
    <table class="table table-striped">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Ingredients</th>
            <th scope="col">Actions</th>
        </tr>
        @foreach($recipes as $recipe)
            <tr>
                <td id="title{{$recipe->id}}">{{$recipe->title}}</td>

                <td>
                    <ul id="recipe{{$recipe->id}}">
                @if(count($recipe->ingredients) >= 1)
                @foreach($recipe->ingredients as $ingredient)
                    
                    <li>
                        {{$ingredient->ingredient_name}} | {{$ingredient->quantity}} {{$ingredient->quantityType}}
                    </li>
                    
                @endforeach
                @else
                    <li>No Ingredients Listed</li>
                @endif
                    </ul>
                </td>

                <td>
                    <div style="display:flex;">
                        <form method="POST" name="copyPostUser" action="{{route('copy.auth')}}">
                            @csrf
                            <button type="submit" style="margin-left:2px;margin-right:2px;" class="btn btn-outline-success" name="copy" onclick="copyText({{$recipe->id}})">Copy</button>
                        </form>
                        <a href="{{route('recipes.edit', $recipe->id)}}"><button type="button" style="margin-left:2px;margin-right:2px;" class="btn btn-outline-secondary" name="edit" >Edit</button></a>
                        <form name="recipeDelete" method="POST" action="{{route('recipes.destroy', $recipe->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="margin-left:2px;margin-right:2px;" class="btn btn-outline-danger" name="delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        {{$recipes->links()}}
    </div>
@endsection

@section('scripts')
<script>
    function copyText(input){
        const text = document.getElementById('recipe'+ input);
        const title = "--" + document.getElementById('title'+ input).textContent + "--\n";
        const list = text.getElementsByTagName('li');
        var trimmed = [title];
        
        for (var i=0; i < list.length; i++){
            var line = list[i].textContent.replace(/\s+/g, ' ').trim();
            trimmed.push(line + '\n');
        }
        const joined = trimmed.join('');
        navigator.clipboard.writeText(joined);
        
    }
</script>

@endsection