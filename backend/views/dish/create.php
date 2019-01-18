<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model kahanov\food\core\forms\DishForm */

$this->title = 'Create dish';
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
