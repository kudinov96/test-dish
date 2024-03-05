<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $type_id
 * @property string $title
 * @property int $price
 */
class Ingredient extends Model
{
    protected $table = 'ingredient';

    protected $guarded = ['id'];

    public function ingredientType(): BelongsTo
    {
        return $this->belongsTo(IngredientType::class, "type_id");
    }
}
