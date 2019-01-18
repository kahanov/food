<?php

namespace kahanov\food\core\entities;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use kahanov\food\core\entities\Ingredient;
use kahanov\food\core\entities\queries\DishQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * The dish entity
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property ingredientAssignment[] $ingredientAssignments
 */
class Dish extends ActiveRecord
{
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

    public $ingredient_count;
	/**
	 * {@inheritdoc}
	 */
	public static function tableName(): string
	{
		return '{{%dish}}';
	}

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['ingredientAssignments'],
            ],
        ];
    }

    /**
     * @return array
     */
    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return DishQuery
     */
    public static function find(): DishQuery
    {
        return new DishQuery(static::class);
    }

    public function enable(): void
    {
        $this->status = self::STATUS_ENABLE;
    }

    public function disable(): void
    {
        $this->status = self::STATUS_DISABLE;
    }

    /**
     * @param $id
     */
    public function assignIngredient($id): void
    {
        $assignments = $this->ingredientAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForIngredient($id)) {
                return;
            }
        }
        $assignments[] = IngredientAssignment::create($id);
        $this->ingredientAssignments = $assignments;
    }

    /**
     * @param $id
     */
    public function revokeIngredient($id): void
    {
        $assignments = $this->ingredientAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForIngredient($id)) {
                unset($assignments[$i]);
                $this->ingredientAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeIngredients(): void
    {
        $this->ingredientAssignments = [];
    }

    /**
     * @return ActiveQuery
     */
    public function getIngredientAssignments(): ActiveQuery
    {
        return $this->hasMany(IngredientAssignment::class, ['dish_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getIngredients(): ActiveQuery
    {
        return $this->hasMany(Ingredient::class, ['id' => 'ingredient_id'])->via('ingredientAssignments');
    }
}
