<?php

namespace app\controllers;

use Yii;
use app\models\Records;
use app\models\RecordsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * RecordsController implements the CRUD actions for Records model.
 */
class RecordsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'event', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'event'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all Records models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecordsSearch();
        $dataProvider = $searchModel->search(['query'=>Yii::$app->request->queryParams]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * Search for distinct emails
     */

    public function actionEmails(){
        $model = new Records();
        $emails = $model->checkNewEmails();

       return $this->render('emails',[
           'emails' => $emails
       ]);
    }




    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /*
     * Displays all records
     * if record is checked  via checkbox it's email address will be displayed at actionEmails
     */
    public function actionEvent()
    {
        $searchModel = new RecordsSearch();
        $dataProvider = $searchModel->search(['query'=>Yii::$app->request->queryParams]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @return array|string|Response
     */
    public function actionCreate()
    {
        $model = new Records();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing Records model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Records model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /*
     * Add new Emails to db
     */
    public function actionAddEmails(){
        foreach(Yii::$app->request->post('checkboxes') as $key=>$value){
            $model = new Records(['scenario' => 'AddEmails']);
            $model->email = $key;
            $model->save();
        }
        return $this->redirect('index');
    }

    /*
     * Displays new Emails.
     * If emails are checked via checkbox they will be saved in db
     */

    public function actionSendEmail()
    {
        $model = new Records();
        $newEmails = $model->getNewRecords(Yii::$app->request->post());
        if(!$newEmails){
           return $this->redirect('/records/index');
       }

        return $this->render('sendEmails',['newEmails'=>$newEmails]);
    }

    /**
     * Finds the Records model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Records the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Records::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
