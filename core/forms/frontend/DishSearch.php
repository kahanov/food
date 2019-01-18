<?php

namespace kahanov\food\core\forms\frontend;

use yii\base\Model;

class DishSearch extends Model
{
    public $id;
	public $name;
	public $status;
    public $ingredientIds;
    public $ingredient_count;

	/**
	 * @return array
	 */
	public function rules(): array
	{
        return [
            [['status'], 'integer'],
            [['name', 'ingredientIds', 'ingredient_count', 'active'], 'safe'],
            [['ingredientIds'], 'required'],
            ['ingredientIds', 'rulesIngredients']
        ];
	}

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'ingredientIds' => 'Select ingredients',
            'ingredient_count' => 'Number of ingredients matched',
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function rulesIngredients($attribute, $params): void
    {
        if (count($this->ingredientIds) <= 1) {
            $this->addError('ingredientIds', "Choose more ingredients");
        }

        if (count($this->ingredientIds) >= 5) {
            $this->addError('ingredientIds', "Up to 5 ingredients can be selected");
        }
    }
}
