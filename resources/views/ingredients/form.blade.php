
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Ingredient Name:</label>
        <input type="text" class="form-control" id="ingredient_name" name="ingredient_name" value="{{$record->ingredient_name}}" style="width:50%;" autofocus required>
        <div>
            <label for="quantityHundreds" class="form-label" style="display:flex;">Quantity: </label>
            <select id="quantityHundreds" name="quantityHundreds" style="border-radius:4px;border:2px #dee2e6 solid;">
                @if($record->quantity >= 100)
                    <option value="{{$record->quantity}}" selected>{{$record->quantity}}</option>
                @endif
                @for ($i = 0; $i <= 1000; $i = $i+100)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor   
            </select>
            <select id="quantityTens" name="quantityTens" style="border-radius:4px;border:2px #dee2e6 solid;">
                @if($record->quantity >= 10 && $record->quantity < 100)
                    <option value="{{$record->quantity}}" selected>{{$record->quantity}}</option>
                @endif
                @for ($i = 0; $i < 100; $i = $i+10)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor   
            </select>
            <select id="quantityOnes" name="quantityOnes" style="border-radius:4px;border:2px #dee2e6 solid;">
                @if($record->quantity >= 1 && $record->quantity < 10)
                    <option value="{{$record->quantity}}" selected>{{$record->quantity}}</option>
                @endif
                @for ($i = 0; $i < 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor   
            </select>
            <select id="quantityFractions" name="quantityFractions" style="border-radius:4px;border:2px #dee2e6 solid;">
                @if($record->quantity >= 0 && $record->quantity < 1)
                    <option value="{{$record->quantity}}" selected>{{$record->quantity}}</option>
                @endif
                <option value="0">0</option>
                <option value="0.125">1/8</option>
                <option value="0.14285714285714285">1/7</option>
                <option value="0.16666666666666666">1/6</option>
                <option value="0.2">1/5</option>
                <option value="0.25">1/4</option>
                <option value="0.3333333333333333">1/3</option>
                <option value="0.375">3/8</option>
                <option value="0.4">2/5</option>
                <option value="0.5">1/2</option>
                <option value="0.6">3/5</option>
                <option value="0.6666666666666666">2/3</option>
                <option value="0.75">3/4</option>
                <option value="0.8">4/5</option>
                <option value="0.8333333333333334">5/6</option>
                <option value="0.8571428571428571">6/7</option>
                <option value="0.875">7/8</option>
                
            </select>
        
            <select id="measurement" name="measurement" style="border-radius:4px;border:2px #dee2e6 solid;">
                <option value="{{$record->quantityType}}" selected>{{$record->quantityType}}</option>
                <option value="lb">lb</option>
                <option value="kg">kg</option>
                <option value="g">g</option>
                <option value="oz">oz</option>
                <option value="fl-oz">fl-oz</option>
                <option value="gal">gal</option>
                <option value="litre">litre</option>
                <option value="cup">cup</option>
                <option value="tbsp">tbsp</option>
                <option value="tsp">tsp</option>
                <option value="egg(s)">egg(s)</option>
                <option value="stick(s)">stick(s)</option>
                <option value="slice(s)">slice(s)</option>
                <option value="can(s)">can(s)</option>
            </select>
            </div>
    </div>
    

