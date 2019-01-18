<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use kahanov\food\core\entities\Dish;
use kahanov\food\core\helpers\DishHelper;

/* @var $this yii\web\View */
/* @var $searchModel kahanov\food\core\forms\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dishes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create dish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'value' => function (Dish $model) {
                    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'status',
                'filter' => DishHelper::statusList(),
                'value' => function (Dish $model) {
                    return DishHelper::statusLabel($model->status);
                },
                'format' => 'raw',
            ],
            ['class' => ActionColumn::class],
        ],
    ]); ?>
</div>
