<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dish kahanov\food\core\entities\Dish */
/* @var $model kahanov\food\core\forms\DishForm */

$this->title = 'Update dish: ' . $dish->name;
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $dish->name, 'url' => ['view', 'id' => $dish->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
