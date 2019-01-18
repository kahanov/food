<?php

namespace kahanov\food\core\repositories;

use kahanov\food\core\entities\Ingredient;
use kahanov\food\core\repositories\NotFoundException;

/**
 * Repository of interaction with the ingredient entity
 */
class IngredientRepository
{
	/**
	 * Get ingredient
	 * @param $id
	 * @return Ingredient
	 */
	public function get($id): Ingredient
	{
        if (!$ingredient = Ingredient::findOne($id)) {
            throw new NotFoundException('Tag is not found.');
        }
        return $ingredient;
	}

	/**
	 * @param Ingredient $ingredient
	 */
	public function save(Ingredient $ingredient): void
	{
		if (!$ingredient->save()) {
			throw new \RuntimeException('Saving error.');
		}
	}

	/**
	 * @param Ingredient $ingredient
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function remove(Ingredient $ingredient): void
	{
		if (!$ingredient->delete()) {
			throw new \RuntimeException('Removing error.');
		}
	}

    /**
     * @param array $condition
     * @return array
     */
    public function getAll($condition = []): array
    {
        return Ingredient::find()->andWhere($condition)->select(['name', 'id'])->all();
    }
}
