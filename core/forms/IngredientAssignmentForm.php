<?php

namespace kahanov\food\core\forms;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use kahanov\food\core\entities\Dish;
use kahanov\food\core\entities\Ingredient;

class IngredientAssignmentForm extends Model
{
	public $existing = [];

    /**
     * IngredientAssignmentForm constructor.
     * @param Dish|null $dish
     * @param array $config
     */
    public function __construct(Dish $dish = null, $config = [])
	{
		if ($dish) {
			$this->existing = ArrayHelper::getColumn($dish->ingredientAssignments, 'ingredient_id');
		}
		parent::__construct($config);
	}

    /**
     * @return array
     */
    public function ingredientsList(): array
    {
        return ArrayHelper::map(Ingredient::find()->andWhere(['status' => 1])->orderBy('name')->asArray()->all(), 'id', 'name');
    }

	/**
	 * @return array
	 */
	public function rules(): array
	{
		return [
			['existing', 'each', 'rule' => ['integer']],
			['existing', 'default', 'value' => []],
		];
	}
}
