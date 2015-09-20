<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\db\Query;
use common\models\Event;
use common\models\Checkin;
use frontend\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Checkin as UCheckin;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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
        ];
    }


    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
            $this->redirect(Yii::$app->urlManager->createUrl('site/login'));

        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $checkinUsers = $searchModel->showCheckin();

        // $x =$searchModel::showCheckin();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'showCheckin'  => $checkinUsers,
            
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $query = new Query;
        $query  ->select(['*'])  
        ->from('checkin')
        ->join( 'JOIN', 
                'message',
                'message.sender_id =checkin.user_id'
            )
        ->join('JOIN',
                'user',
                'user.id = checkin.user_id')
        ->distinct()
        ->all(); 
$command = $query->createCommand();
$data = $command->queryAll();               

                        //die();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'messages' => $data
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();

        // $user = $this->findModel(Yii::$app->user->id);
        // $model->location = $user->address;

        if ($model->load(Yii::$app->request->post())) {

            $model->eeopen_date = $model->eopen_date;
            $model->organiser_id = Yii::$app->user->id;
            $model->created_date =  date("Y-m-d h:i:sa");
            $model->updated_date =  date("Y-m-d h:i:sa");
            $model->created_by = Yii::$app->user->id;
            $model->updated_by = Yii::$app->user->id;
            $model->is_active = 1 ;

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
                return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionTake()
    {
         return $this->render('index', ['time' => date('H:i:s')]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->updated_date =  date("Y-m-d h:i:sa");
            $model->updated_by = Yii::$app->user->id;
            $model->is_active = 1 ;
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
