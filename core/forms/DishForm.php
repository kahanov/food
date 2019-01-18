<?php

namespace kahanov\food\core\forms;

use kahanov\food\core\entities\Dish;
use kahanov\food\core\forms\CompositeForm;

/**
 * DishForm is the model behind the Dish form.
 *
 *  @property IngredientAssignmentForm $ingredients
 */
class DishForm extends CompositeForm
{
    public $name;
    public $status;

    /**
     * DishForm constructor.
     * @param Dish|null $dish
     * @param array $config
     */
    public function __construct(Dish $dish = null, $config = [])
    {
        if ($dish) {
            $this->name = $dish->name;
            $this->status = $dish->status;
        }
        $this->ingredients = new IngredientAssignmentForm($dish);
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'integer']
        ];
    }

    /**
     * @return array
     */
    protected function internalForms(): array
    {
        return ['ingredients'];
    }
}
