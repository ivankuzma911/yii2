<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Records */


?>
<div class="records-view">

    <span><?= Html::encode('Information') ?></span>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first',
            'last',
            'email:email',
            'home',
            'work',
            'cell',
            'zip',
            'state',
            'country',
            'best_phone',
            'birthday',
            'address1',
            'address2',
            'city:ntext',
        ],
        'options'=>['class'=>'view'],
        'template'=> '<tr><th>{label}:</th><td>{value}</td></tr>'
    ]) ?>

</div>

