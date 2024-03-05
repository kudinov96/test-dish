<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $code
 */
class IngredientType extends Model
{
    protected $table = 'ingredient_type';

    protected $guarded = ['id'];

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class, "type_id");
    }
}
