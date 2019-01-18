<?php

namespace kahanov\food\core\services;

use yii\helpers\ArrayHelper;
use kahanov\food\core\entities\Ingredient;
use kahanov\food\core\forms\IngredientForm;
use kahanov\food\core\repositories\DishRepository;
use kahanov\food\core\entities\IngredientAssignment;
use kahanov\food\core\repositories\IngredientRepository;

class IngredientService
{
    private $repository;

    /**
     * IngredientService constructor.
     * @param IngredientRepository $repository
     */
    public function __construct(IngredientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param IngredientForm $form
     * @return Ingredient
     */
    public function create(IngredientForm $form): Ingredient
    {
        $ingredient = new Ingredient();
        $ingredient->name = $form->name;
        if ($form->status === '0') {
            $ingredient->disable();
        } else {
            $ingredient->enable();
        }
        $this->repository->save($ingredient);
        return $ingredient;
    }

    /**
     * @param IngredientForm $form
     * @param int $id
     */
    public function edit(IngredientForm $form, int $id): void
    {
        $ingredient = $this->repository->get($id);
        $ingredient->name = $form->name;
        if ($form->status === '0') {
            $ingredient->disable();
            $this->dishEditStatus('disable', $id);
        } else {
            $ingredient->enable();
            $this->dishEditStatus('enable', $id);
        }
        $this->repository->save($ingredient);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $ingredient = $this->repository->get($id);
        $this->repository->remove($ingredient);
    }

    private function dishEditStatus($status, $ingredientId): void
    {
        $dishIds = ArrayHelper::map(IngredientAssignment::getIngredientAssignments(['ingredient_id' => $ingredientId]), 'dish_id', 'dish_id');
        if (!empty($dishIds)) {
            $dishRepository = new DishRepository();
            foreach ($dishIds as $dishId) {
                $dish = $dishRepository->get($dishId);
                $dish->$status();
                $dishRepository->save($dish);
            }
        }
    }
}
