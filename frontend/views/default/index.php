<?php
/* @var $this yii\web\View */
/* @var $ingredients kahanov\food\core\entities\Ingredient */
/* @var $searchForm kahanov\food\core\forms\frontend\DishSearch */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kahanov\food\assets\FontAwesomeAsset;

FontAwesomeAsset::register($this);

$this->title = 'Dishes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group input-group input-group-sm">
                <?php $form = ActiveForm::begin([
                    'method' => 'GET',
                ]); ?>
                <?php echo $form->field($searchForm, 'ingredientIds')->label(false)->widget(Select2::class, [
                    'data' => $ingredients,
                    'language' => 'ru',
                    'showToggleAll' => false,
                    'options' => ['placeholder' => 'Choose an ingredient...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'maximumSelectionLength' => 5,
                    ],
                    'addon' => [
                        'prepend' => [
                            'content' => 'Ingredients:'
                        ],
                        'append' => [
                            'content' => Html::submitButton('<i class="fa fa-search"></i></a>', ['class' => 'btn btn-success']),
                            'asButton' => true
                        ]
                    ]
                ]); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'ingredient_count',
                ],
            ]); ?>
        </div>
    </div>
</div>
