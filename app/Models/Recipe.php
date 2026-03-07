<?php
// ============================================================
// app/Models/Recipe.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    protected $fillable = ['name', 'servings', 'instructions'];

    public function ingredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function requiredIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class)->where('is_optional', false);
    }
}
