<?php

namespace app\models;

use yii\base\Model;
use Yii;

/**
 * LoginForm is the model behind the login form.
 */
class RegistrationForm extends Model
{
    public $username;
    public $password;


    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'],'filter', 'filter' => 'trim'],
            [['username', 'password'],'required'],

            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'This username is already taken'],
            ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',

            'password' => 'Password'
        ];
    }

    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);

        return $user->save() ? $user : null;
    }

}
