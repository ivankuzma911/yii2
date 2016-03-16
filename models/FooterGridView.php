<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 22.02.2016
 * Time: 15:56
 */
namespace app\models;

use yii\grid\GridView;
use yii\helpers\Html;
use yii;

class FooterGridView extends GridView
{
    /*
     * rewrite table footer of gridView widget depending of controller action
     */

    public function renderTableFooter()
    {
        if(Yii::$app->controller->action->id == 'event') {
            $content = HTML::a('Send', '/records/emails',['class'=>'event_submit']);
            return "<tfoot class='table-footer'><tr><td colspan='6'>\n" . $content . "\n</td></tr></tfoot>";
        }else{
            return parent::renderTableFooter();
        }
    }
}