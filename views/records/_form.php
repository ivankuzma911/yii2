<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Records */
/* @var $form yii\widgets\ActiveForm */
$values = $model->getValuesForBirthday();
$model->best_phone = 'home';
?>

<div class="records-form">

    <?php $form = ActiveForm::begin(
        ['validateOnType'=>true]
    ); ?>

    <?= $form->field($model, 'first')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email',['enableAjaxValidation'=>true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'best_phone')->radio(['label'=>null, 'uncheck'=>null,'value'=>'home']) ?>

    <?= $form->field($model, 'home')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'best_phone')->radio(['label'=>null,'uncheck'=>null,'value'=>'work']) ?>

    <?= $form->field($model, 'work')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'best_phone')->radio(['label'=>null,'uncheck'=>null,'value'=>'cell']) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'day',['options'=>['class'=>'days-drop']])->dropDownList($values['days'])->label('Birthday')?>

    <?= $form->field($model, 'month')->dropDownList($values['months'])->label(false) ?>

    <?= $form->field($model, 'year')->dropDownList($values['years'])->label(false)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'create-button' : 'update-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
