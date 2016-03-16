<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$form = ActiveForm::begin([
    'id' => 'login-form',
    'validateOnType'=>true

]) ?>
    <h4>Registration</h4>
<?= $form->field($model, 'username',['enableAjaxValidation'=>true]) ?>
<?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
            <?= Html::submitButton('Registrate') ?>
        </div>

<?php ActiveForm::end() ?>

