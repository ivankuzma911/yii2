<?php

namespace app\models;

use Yii;
use yii\helpers\html;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "records".
 *
 * @property integer $id
 * @property string $first
 * @property string $last
 * @property string $email
 * @property string $home
 * @property string $work
 * @property string $cell
 * @property string $zip
 * @property string $state
 * @property string $country
 * @property string $best_phone
 * @property string $user_id
 * @property string $birthday
 * @property string $address1
 * @property string $address2
 * @property string $city
 */
class Records extends \yii\db\ActiveRecord
{

    public $year;
    public $month;
    public $day;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'records';
    }



    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->birthday = Yii::$app->formatter->asDate($this->birthday);
        $date = explode('-',$this->birthday);
        if(isset($date[2])) {
            $this->day = $date[0];
            $this->month = $date[1];
            $this->year = $date[2];
        }
        return parent::afterFind();
    }



    public function beforeSave($insert) {
       if(parent::beforeSave($insert)){
           if($this->isNewRecord){
               $this->user_id = Yii::$app->user->id;
           }
          $this->best_phone = $this->getBestPhone();
          $this->birthday = $this->year .'-'. $this->month .'-'. $this->day;
        return true;
       }
        return false;
    }

    public function rules()
    {
        return [
            [['city'], 'string','except'=>'AddEmails'],
            [['email'],'email','except'=>'AddEmails'],
            [['email'],'unique','except'=>'AddEmails'],
            [['first','year','month','day', 'last', 'email', 'home', 'work', 'cell', 'zip', 'state', 'country', 'address1', 'address2'], 'required' ,'except'=>'AddEmails'],
            [['first', 'last', 'email', 'home', 'work', 'cell', 'zip', 'state', 'country', 'best_phone', 'user_id', 'address1', 'address2'], 'string','min'=>1, 'max' => 32 ,'except'=>'AddEmails'],
            [['first', 'last', 'email', 'home', 'work', 'cell', 'zip', 'state', 'country', 'best_phone', 'user_id', 'address1', 'address2'], 'default','value'=>'Not set','on'=>'AddEmails']
        ];
    }




    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first' => 'First',
            'last' => 'Last',
            'email' => 'Email',
            'home' => 'Home',
            'work' => 'Work',
            'cell' => 'Cell',
            'zip' => 'Zip',
            'state' => 'State',
            'country' => 'Country',
            'best_phone' => 'Best Phone',
            'user_id' => 'User ID',
            'birthday' => 'Birthday',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'year'=>'year',
            'day'=>'day',
            'month'=>'month'
        ];
    }

    public function getNewRecords($email){
        $emails = explode(';',$email['emails']);
        foreach($emails as $key=>$value){
            if(!Records::find()->where(['email'=>$value,'user_id'=>Yii::$app->user->id])->exists() && $value != ''){
                $newEmails[] = $value;
            }
        }
        setcookie("checkboxes", "", time()-3600);

        if(empty($newEmails)){
            return false;
        }
        return $newEmails;
    }

    /*
     * checks cookies array values for new emails from db
     */


    public function checkNewEmails(){
        $emails ="";
        if(isset($_COOKIE['checkboxes'])) {
            $cookies = $_COOKIE['checkboxes'];
            $cookiesValues = explode(',', $cookies);
            $emails = implode(';', ArrayHelper::getColumn(Records::find()->where(['id' => $cookiesValues,'user_id'=>Yii::$app->user->id])->select('email')->asArray()->all(), 'email'));
        }
        return $emails;
    }

    /*
    *  Generating values for select options
    */


    public function getValuesForBirthday(){
       $values = array();
        for($i=1;$i<=31;$i++){
            $values['days'][$i] = $i;
        }
        for($i=1;$i<=12;$i++){
            $values['months'][$i] = $i;
        }
        for($i=1960;$i<=2015;$i++){
            $values['years'][$i] = $i;
        }

        return $values;
    }

    /*
     * getting Best phone of record depending on db's value
     */

    public function getBestPhone(){
        $mark = Yii::$app->request->post();
        if(isset($mark['Records']['best_phone'])) {
            switch ($mark['Records']['best_phone']) {
                case 'home':
                    return $this->home;
                    break;
                case 'work':
                    return $this->work;
                    break;
                case 'cell':
                    return $this->cell;
                    break;
                default:
                    return $this->home;
                    break;
            }
        }else{
            return $this->best_phone;
        }
    }
}
