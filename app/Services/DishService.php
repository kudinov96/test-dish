<?php

namespace App\Services;

use App\Models\IngredientType;
use Illuminate\Support\Collection;

class DishService
{
    private IngredientType $ingredientType;
    private DishFormatter  $dishFormatter;

    public function __construct(IngredientType $ingredientType, DishFormatter $dishFormatter)
    {
        $this->ingredientType = $ingredientType;
        $this->dishFormatter  = $dishFormatter;
    }

    public function variableDishesByCode(string $dishCode): Collection
    {
        foreach (str_split($dishCode) as $code) {
            if (!$ingredientType = $this->ingredientType->where("code", $code)->first()) {
                throw new \LogicException("Передан несуществующий тип в коде': $code");
            }

            $ingredients = $ingredientType->ingredients()->with(["ingredientType"])->get();

            if ($ingredients->isEmpty()) {
                throw new \LogicException("Нет ингредиентов типа: {$ingredientType->title}");
            }

            $ingredientTypesByCode[$code] = $ingredients;
        }

        $variables = [];
        $this->generateVariables($ingredientTypesByCode, $variables, $dishCode);

        return $this->dishFormatter->format($variables);
    }

    private function generateVariables(array $ingredientTypesByCode, array &$variables, string $dishCode, array $currentVariable = [], int $position = 0): void
    {
        if ($position === strlen($dishCode)) {
            sort($currentVariable);

            if (!in_array($currentVariable, $variables)) {
                $variables[] = $currentVariable;
            }

            return;
        }

        $currentCode = $dishCode[$position];

        foreach ($ingredientTypesByCode[$currentCode] as $ingredient) {
            if (in_array($ingredient->id, array_column($currentVariable, 'id'))) {
                continue;
            }

            $newVariable = array_merge($currentVariable, [$ingredient]);
            $this->generateVariables($ingredientTypesByCode, $variables, $dishCode, $newVariable, $position + 1);
        }
    }
}
