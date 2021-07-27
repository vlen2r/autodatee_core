<?php

namespace app\controllers;

use Yii;
use app\models\Historial;
use app\models\Importado;
use app\models\HistorialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HistorialController implements the CRUD actions for Historial model.
 */
class HistorialController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Historial models.
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * Agregado por Batista 2021-07-26
         * Para filtrar mediante el nombre del cliente.
         * Siendo cliente una tabla foranea de Historial.
         */
        $model=HistorialSearch::model()->findAll();
        $content=$this->renderPartial("excel",array("model"=>$model),true);
        Yii::app()->request->sendFile("CantidadCliente.xls",$content);
        //Fin del agregado Batista 2021-07-26
        
        $searchModel = new HistorialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

//Batista
//I think it's mine. I tried to add code for filter by a camp of an foreign table.
//    public function actionImportado()
//    {
//        $dataProvider = new Importado();
//        /*$dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/
//
//        return $this->render('index', [
//            /*'searchModel' => $searchModel,*/
//            'dataProvider' => $dataProvider,
//        ]);
//    }


    /**
     * Displays a single Historial model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Historial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Historial();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Historial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Historial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Historial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Historial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Historial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
