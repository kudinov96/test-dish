<?php

namespace App\Services;

use Illuminate\Support\Collection;

class DishFormatter
{
    public function format(array $variables): Collection
    {
        $result = new Collection();
        foreach ($variables as $variable) {
            $products = [];
            $price    = 0;

            foreach ($variable as $ingredient) {
                $products[] = [
                    "type"  => $ingredient->ingredientType->title,
                    "value" => $ingredient->title,
                ];

                $price += $ingredient->price;
            }

            $result->push([
                "products" => $products,
                "price"    => $price,
            ]);
        }

        return $result;
    }
}
