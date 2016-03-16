<?php

use yii\helpers\Html;
use app\models\FooterGridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\RecordsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $columns app\models\Records */

$this->title = 'Records';

    $columns = [
        ['class' => 'yii\grid\SerialColumn',
            'header'=>'',
            'visible' => Yii::$app->controller->action->id == 'index'
        ],
        ['class' => 'yii\grid\CheckboxColumn',
            'header'=>'<span name="selection_all" id="check-all">All</span>',
            'visible' => !(Yii::$app->controller->action->id == 'index'),
            'contentOptions' => ['class'=>'checkboxes']
        ],
        'first',
        'last',
        'email',
        'best_phone',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '<div class="action_td">{add} {update} {view} {delete}</div>',
            'header'=>'Actions',
            'headerOptions'=>[
                'class'=>'actions_header'
            ],
            'contentOptions'=>[
                'class'=>'actions_buttons',
            ],
            'buttons'=>[
                'delete'=>function ($url) {
                    return Html::a(Html::img('../images/delete_button.png'), $url,['class'=>'delete_button','data-method'=>'post']);
                },
                'view'=>function ($url) {
                    return Html::a('View', $url,['class'=>'view_button']);
                },
                'update'=>function ($url) {
                    return Html::a('Edit', $url,['class'=>'update_button']);
                },
                'add'=>function () {
                    return Html::a('Add', '/records/create',['class'=>'add_button']);
                },
            ],
            'visible' => Yii::$app->controller->action->id == 'index'

        ],
    ];

?>
<div class="records-index">




<?php Pjax::begin(['id'=>'pAjax']);?>

    <?= FooterGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns,
        'summary'=>false,
        'options'=>['id'=>'table'],
        'showFooter'=>true,
        'footerRowOptions'=>['class'=>'table-footer'],
        'pager'=>[
            'maxButtonCount'=>5,
            'firstPageCssClass'=>'first-page',
            'firstPageLabel'=>'<img src="../images/arrows_left.png">First',
            'lastPageCssClass'=>'last-page',
            'lastPageLabel'=>'Last<img src="../images/arrows_right.png">',
            'nextPageLabel'=>'Next<img src="../images/next_image.png">',
            'prevPageLabel'=>'<img src="../images/prev_image.png">Prev'
        ],
        'emptyText' => 'Press \'Add \' to add new contacts ' . Html::a('Add', '/records/create',['class'=>'emptyButton'])
    ]); ?>



<?php Pjax::end()?>
</div>


<?php (Yii::$app->controller->action->id == 'event') ?     $this->registerJsFile('../js/pjaxHelper.js',['position' => \yii\web\View::POS_END]) : "" ?>
<?php  (Yii::$app->controller->action->id == 'event') ?     $this->registerJsFile('../js/main.js',['position' => \yii\web\View::POS_END]) : "" ?>





