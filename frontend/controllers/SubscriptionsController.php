<?php

namespace frontend\controllers;

use Yii;
use app\models\Subscriptions;
use app\models\SubscriptionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTime;
use DateInterval;

/**
 * SubscriptionsController implements the CRUD actions for Subscriptions model.
 */
class SubscriptionsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all Subscriptions models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new SubscriptionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /*
         * Get attributes label and format well
         */
        $ignoreThis = [];
//        $ignoreThis = ['practice_no','tel_no'];
        $attributeLabels = $searchModel->attributeLabels();
        $attributesArr = [];
        $attributesArrExcel = [];
        foreach ($attributeLabels as $key => $value) {
            if (!in_array($key, $ignoreThis)) {
                array_push($attributesArr, ['dataKey' => $key, 'title' => $value]);
                array_push($attributesArrExcel, $value);
            }
        }
        $columns = json_encode($attributesArr);
        $columnsExcel = json_encode($attributesArrExcel);

        /*
         * Get fillterd data
         */

        $filteredDataResults = $dataProvider->getModels();

        $mainArrFilteredData = [];
        $mainArrFilteredDataExcel = [];
        foreach ($filteredDataResults as $key => $value) {
            $subArr = [];
            $subArrExcel = [];
            foreach ($value as $key => $value) {

                if (!in_array($key, $ignoreThis)) {
                    $subArr[$key] = $value;
                }
                if (!in_array($key, $ignoreThis)) {
                    array_push($subArrExcel, $value);
                }
            }
            array_push($mainArrFilteredData, $subArr); //pdf
            array_push($mainArrFilteredDataExcel, $subArrExcel); //excel
        }
        $filteredJson = json_encode($mainArrFilteredData);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'columns' => $columns,
                    'filteredJson' => $filteredJson,
                    'mainArrFilteredDataExcel' => json_encode($mainArrFilteredDataExcel),
                    'columnsExcel' => $columnsExcel,
        ]);
    }

    /**
     * Displays a single Subscriptions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Subscriptions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Subscriptions();

        if ($model->load(Yii::$app->request->post())) {


            $model->created_at = date('Y-m-d H:i:s');
            
            if ($model->duration == '1') {
                $date =  new DateTime($model->created_at);
                $date->add(new DateInterval('P1M'));
            } else {
                 $date =  new DateTime($model->created_at);
                $date->add(new DateInterval('P12M'));
            }

            $model->expires_at = $date->format('Y-m-d H:i:s');
            $model->status = 'Active';


            if ($model->save()) {
                echo 'success';
            } else {
                $array_of_errors = $model->errors;
                $str = '';
                foreach ($array_of_errors as $key => $value) {
                    $str .= ' ' . implode('', $value) . ' ';
                }
                echo $str;
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subscriptions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Subscriptions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetAmount($id,$duration) {
        $records = \app\models\Product::find()->where(['id' => $id])->one();
        
        if($duration == 1){
            echo $records->monthlyprice;
        }else{
            echo $records->annualprice;
        }

        
    }

    /**
     * Finds the Subscriptions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subscriptions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Subscriptions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
