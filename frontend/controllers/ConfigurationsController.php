<?php

namespace frontend\controllers;

use Yii;
use app\models\Configurations;
use app\models\ConfigurationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfigurationsController implements the CRUD actions for Configurations model.
 */
class ConfigurationsController extends Controller
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
     * Lists all Configurations models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new ConfigurationsSearch();
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
     * Displays a single Configurations model.
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
     * Creates a new Configurations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Configurations();

        if ($model->load(Yii::$app->request->post())) {
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
     * Updates an existing Configurations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Configurations model.
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
     * Finds the Configurations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Configurations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Configurations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
