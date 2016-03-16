<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\RegistrationForm;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use Yii;
use yii\web\Response;



class UsersController extends Controller
{


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model =  new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render(
            'login',
            [
                'model' => $model
            ]
        );
    }


    public function actionRegistration()
    {
        $model = new RegistrationForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->reg()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('/records/index');
                }
            }
        }
        return $this->render(
            'registration',
            [
                'model' => $model
            ]
        );
    }

    public function actionLogout()
    {
        setcookie("checkboxes", "", time()-3600);
        Yii::$app->user->logout();

        return $this->goHome();
    }

}