<?php
/* @var $newEmails app\models\Records*/
use yii\helpers\html;

?>
<div class='emails-content'>
<p>Picture/invite shared succussfully</p>
<p>This emails is not in your contact manager:</p>
<?= Html::beginForm('add-emails')?>
<table>
    <tbody>
        <?php foreach($newEmails as $key=>$email):?>
        <tr>
            <td><?= Html::checkbox("checkboxes[$email]")?></td>
            <td><?=$email?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?=  Html::submitButton('Add',['id'=>'emails-submit'])?>
<?= Html::endForm()?>
</div>


