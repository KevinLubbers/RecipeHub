<form name="ingredientCreateRoute" method="POST" action="{{route('create.ingred', $record->id)}}">
    @csrf
    <button type="submit" class="btn btn-outline-primary" style="margin-bottom:20px;margin-top:8px;">Create New Ingredient</button>
    
</form>
@include('flashmsgs.msgs')
    <table class="table table-striped">
        <tr>
            <th scope="col">Ingredient</th>
            <th scope="col">Quantity</th>
            <th scope="col">Actions</th>
        </tr>
            @foreach($record->ingredients as $ingredient)
            @if($ingredient->recipe_id == $record->id)
                <tr>    
                    <td>
                        {{$ingredient->ingredient_name}} 
                    </td>
                    <td>
                        {{$ingredient->quantity}} {{$ingredient->quantityType}}
                    </td>
            @endif    
                    <td style="display:flex;">
                        <a href="{{route('ingredients.edit', $ingredient->id)}}"><button type="button" style="margin-left:2px;margin-right:2px;" class="btn btn-outline-secondary" name="edit" >Edit</button></a>
                        <form name="ingredientDelete" method="POST" action="{{route('ingredients.destroy', $ingredient->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="margin-left:2px;margin-right:2px;" class="btn btn-outline-danger" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>

