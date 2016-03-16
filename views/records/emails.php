<?php
/*
 * @var $emails string */
use yii\helpers\Html;
?>

<?php

echo "<div class='emails-content'>";
echo Html::beginForm([
    '/records/send-email']);

echo Html::label('Email to:','emails',['id'=>'emails-label']);
echo Html::textInput('emails', $emails);
echo Html::a('Add emails','/records/event',['class'=>'emails-link']);

echo Html::label('Type some text:','email-content',['id'=>'area-label']);
echo Html::textarea('email-content');

echo Html::submitButton('submit',['id'=>'emails-submit']);

echo Html::endForm();
echo "</div>";



