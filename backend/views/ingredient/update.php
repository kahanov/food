<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $ingredient kahanov\food\core\entities\Ingredient */
/* @var $model kahanov\food\core\forms\IngredientForm */

$this->title = 'Update ingredient: ' . $ingredient->name;
$this->params['breadcrumbs'][] = ['label' => 'Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $ingredient->name, 'url' => ['view', 'id' => $ingredient->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingredient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
