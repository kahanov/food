<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use kahanov\food\core\entities\Ingredient;
use kahanov\food\core\helpers\IngredientHelper;

/* @var $this yii\web\View */
/* @var $searchModel kahanov\food\core\forms\IngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create ingredient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'value' => function (Ingredient $model) {
                    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'status',
                'filter' => IngredientHelper::statusList(),
                'value' => function (Ingredient $model) {
                    return IngredientHelper::statusLabel($model->status);
                },
                'format' => 'raw',
            ],
            ['class' => ActionColumn::class],
        ],
    ]); ?>
</div>
