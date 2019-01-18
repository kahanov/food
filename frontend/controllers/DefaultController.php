<?php

namespace kahanov\food\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use kahanov\food\core\forms\frontend\DishSearch;
use kahanov\food\core\repositories\DishRepository;
use kahanov\food\core\repositories\IngredientRepository;

class DefaultController extends Controller
{
    private $dish;
    private $ingredient;

    /**
     * DefaultController constructor.
     * @param $id
     * @param $module
     * @param DishRepository $dish
     * @param IngredientRepository $ingredient
     * @param array $config
     */
    public function __construct($id, $module, DishRepository $dish, IngredientRepository $ingredient, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->dish = $dish;
        $this->ingredient = $ingredient;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new DishSearch();
        $form->load(Yii::$app->request->queryParams);
        $dataProvider = $this->dish->search($form);
        $ingredients = ArrayHelper::map($this->ingredient->getAll(['status' => 1]), 'id', 'name');
        return $this->render('index', [
            'searchForm' => $form,
            'dataProvider' => $dataProvider,
            'ingredients' => $ingredients,
        ]);
    }
}
