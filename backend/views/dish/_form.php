<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model kahanov\food\core\forms\DishForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->widget(SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'On',
            'offText' => 'Off',
        ]
    ]) ?>
    <?= $form->field($model->ingredients, 'existing')->checkboxList($model->ingredients->ingredientsList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
