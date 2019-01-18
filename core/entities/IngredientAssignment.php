<?php

namespace kahanov\food\core\entities;

use yii\db\ActiveRecord;

/**
 * @property integer $dish_id;
 * @property integer $ingredient_id;
 */
class IngredientAssignment extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%ingredient_assignment}}';
    }

    /**
     * @param $ingredientId
     * @return ingredientAssignment
     */
    public static function create($ingredientId): self
    {
        $assignment = new static();
        $assignment->ingredient_id = $ingredientId;

        return $assignment;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isForIngredient($id): bool
    {
        return $this->ingredient_id == $id;
    }

    /**
     * @param array $condition
     * @return array
     */
    public static function getIngredientAssignments($condition = []): array
    {
        return IngredientAssignment::find()->andWhere($condition)->asArray()->all();
    }
}
