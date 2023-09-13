@extends('main')

@section('content')
<h1>Browse - Recipes</h1>
@include('flashmsgs.msgs')
<table class="table table-striped">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Ingredients</th>
        <th scope="col">Multiply By</th>
        <th scope="col">Actions</th>
    </tr>
    @foreach($recipes as $recipe)
        <tr>
            <td>
                <div id="title{{$recipe->id}}">{{$recipe->title}}</div>
                <div style="font-size:.5em;">Created By: {{$recipe->username}}</div>
                <div style="font-size:.5em;">Date: {{$recipe->created_at->format('m-d-Y H:i')}}</div>
            </td>
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
            <td><input type="text" size="3" maxlength="3" value=1 name="multiply" id="multiply{{$recipe->id}}" oninput="multiplyText(this.value, {{$recipe->id}})"/></td>
            <td>
                <form method="POST" name="copyPost" action="{{route('copy.post')}}">
                    @csrf
                    <button type="submit" style="margin-left:2px;margin-right:2px;" class="btn btn-outline-success" name="copy" onclick="copyText('{{$recipe->id}}')">Copy Recipe to Clipboard</button>
                </form>
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
        var multiply = document.getElementById('multiply'+input).value;
        var multiplyText = "";
        if(multiply != 1){
            multiplyText = "Multiplied from Original Recipe: x " + multiply;
        }
        
        const text = document.getElementById('recipe'+ input);
        const title = "--" + document.getElementById('title'+ input).textContent + "--\n";
        const list = text.getElementsByTagName('li');
        var trimmed = [title];
        
        for (var i=0; i < list.length; i++){
            var line = list[i].textContent.replace(/\s+/g, ' ').trim();
            trimmed.push(line + '\n');
        }
        trimmed.push(multiplyText);
        const joined = trimmed.join('');
        navigator.clipboard.writeText(joined);
        
        
    }

    function multiplyText(times, input){

        if(isNaN(times) || times == ""){
            times = 1;
        }    
        const text = document.getElementById('recipe'+ input);
        const list = text.getElementsByTagName('li');
        var copyNum = [];
        var copyString = [];

        for (var i=0; i < list.length; i++){
            copyNum[i] = list[i].textContent.match(/\d+(\.\d+)?/g).map(parseFloat) * parseFloat(times);
            copyString[i] = list[i].textContent.split(" ");
            copyString[i] = copyString[i].filter(function(element){
                return element.trim() !== '';
            });

            if(Number.isInteger(copyNum[i])){
                copyString[i][(copyString[i].length - 2)] = copyNum[i];
            }
            else{
                copyString[i][(copyString[i].length - 2)] = copyNum[i].toFixed(2);
            }
            
            list[i].textContent = copyString[i].join(" ");
            
        }

    }
  
    

</script>

@endsection