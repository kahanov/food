<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model kahanov\food\core\forms\IngredientForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->widget(SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'On',
            'offText' => 'Off',
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
