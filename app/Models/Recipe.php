<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Recipe extends Model
{
    protected $table = 'recipes';
    
    public $recipe_title = 'title';
    
    public $timestamps = true;

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }
}
