<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'login-form',
]) ?>
    <h4>Authorization</h4>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
    <?= Html::a('Register now','/users/registration') ?>
    <div class="form-group">
            <?= Html::submitButton(Html::img('../images/dots.jpg', ['id' => 'submit-image'])."Login") ?>
    </div>
<?php ActiveForm::end() ?>


