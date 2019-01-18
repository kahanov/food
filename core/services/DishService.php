<?php

namespace kahanov\food\core\services;

use kahanov\food\core\entities\Dish;
use kahanov\food\core\forms\DishForm;
use kahanov\food\core\repositories\DishRepository;
use kahanov\food\core\services\TransactionManager;
use kahanov\food\core\repositories\IngredientRepository;

class DishService
{
    private $dish;
    private $ingredient;
    private $transaction;

    /**
     * DishService constructor.
     * @param DishRepository $dish
     * @param IngredientRepository $ingredient
     * @param \kahanov\food\core\services\TransactionManager $transaction
     */
    public function __construct(
        DishRepository $dish,
        IngredientRepository $ingredient,
        TransactionManager $transaction
    )
    {
        $this->dish = $dish;
        $this->ingredient = $ingredient;
        $this->transaction = $transaction;
    }

    /**
     * @param DishForm $form
     * @return Dish
     * @throws \Throwable
     */
    public function create(DishForm $form): Dish
    {
        $dish = new Dish();
        $dish->name = $form->name;
        if ($form->status === '0') {
            $dish->disable();
        } else {
            $dish->enable();
        }
        foreach ($form->ingredients->existing as $ingredientId) {
            $ingredient = $this->ingredient->get($ingredientId);
            $dish->assignIngredient($ingredient->id);
        }
        $this->transaction->wrap(function () use ($dish, $form) {
            $this->dish->save($dish);
        });
        return $dish;
    }

    /**
     * @param DishForm $form
     * @param $id
     * @throws \Throwable
     */
    public function edit(DishForm $form, $id): void
    {
        $dish = $this->dish->get($id);
        $dish->name = $form->name;
        if ($form->status === '0') {
            $dish->disable();
        } else {
            $dish->enable();
        }
        $this->transaction->wrap(function () use ($dish, $form) {
            $dish->revokeIngredients();
            $this->dish->save($dish);
            foreach ($form->ingredients->existing as $ingredientId) {
                $ingredient = $this->ingredient->get($ingredientId);
                $dish->assignIngredient($ingredient->id);
            }
            $this->dish->save($dish);
        });
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $dish = $this->dish->get($id);
        $this->dish->remove($dish);
    }
}
