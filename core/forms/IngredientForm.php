<?php

namespace kahanov\food\core\forms;

use yii\base\Model;
use kahanov\food\core\entities\Ingredient;

class IngredientForm extends Model
{
    public $name;
    public $status;

    /**
     * IngredientForm constructor.
     * @param Ingredient|null $ingredient
     * @param array $config
     */
    public function __construct(Ingredient $ingredient = null, $config = [])
    {
        if ($ingredient) {
            $this->name = $ingredient->name;
            $this->status = $ingredient->status;
        }
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
}
