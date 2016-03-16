<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Records */

$this->title = 'Create Record';
?>
<div class="records-create">

    <span><?= Html::encode($this->title) ?></span>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

