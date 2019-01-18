<?php

namespace kahanov\food\core\repositories;

use yii\data\ArrayDataProvider;
use kahanov\food\core\entities\Dish;
use kahanov\food\core\forms\frontend\DishSearch;
use kahanov\food\core\repositories\NotFoundException;

/**
 * Repository of interaction with the dish entity
 */
class DishRepository
{
    /**
     * Get dish
     * @param $id
     * @return Dish
     */
    public function get($id): Dish
    {
        if (!$dish = Dish::findOne($id)) {
            throw new NotFoundException('Tag is not found.');
        }
        return $dish;
    }

    /**
     * @param Dish $dish
     */
    public function save(Dish $dish): void
    {
        if (!$dish->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Dish $dish
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Dish $dish): void
    {
        if (!$dish->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    /**
     * @param DishSearch $form
     * @return ArrayDataProvider
     */
    public function search(DishSearch $form): ArrayDataProvider
    {
        $query = Dish::find()->alias('d')->active('d')->with('ingredientAssignments');
        $dataProvider = new ArrayDataProvider();
        if ($form->ingredientIds && $form->validate()) {
            $query->select(['d.*', 'COUNT(ia.dish_id) ingredient_count']);
            $query->joinWith(['ingredientAssignments ia'], true, 'INNER JOIN');
            $query->andWhere(['ia.ingredient_id' => $form->ingredientIds]);
            $query->groupBy('ia.dish_id');
            $query->having('ingredient_count > 1');
            $query->orderBy('ingredient_count DESC');
            $all = $query->all();
            if ($all) {
                $dishes = [];
                foreach ($all as $dish) {
                    $dishes[$form->ingredient_count][] = $dish;
                }
                if (isset($dishes[count($form->ingredientIds)])) {
                    $all = $dishes[count($form->ingredientIds)];
                }
            }
            $dataProvider->allModels = $all;
        }
        return $dataProvider;
    }
}
