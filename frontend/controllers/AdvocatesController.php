<?php

namespace frontend\controllers;

use Yii;
use app\models\Tbadvocates;
use frontend\models\TbadvocatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdvocatesController implements the CRUD actions for Tbadvocates model.
 */
class AdvocatesController extends Controller {

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
     * Lists all Tbadvocates models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TbadvocatesSearch();
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
     * Displays a single Tbadvocates model.
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
     * Creates a new Tbadvocates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tbadvocates();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tbadvocates model.
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
     * Deletes an existing Tbadvocates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbadvocates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tbadvocates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tbadvocates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionImportExcel() {

        try {

            $inputFileName = 'uploads/advocates.xlsx';
            try {
                if (!$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName)) {
                    
                }
            } catch (\Exception $e) {
                //print_r($e->getMessage());
            }

            $sheet = $spreadsheet->getSheet(0);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 1; $row <= $highestRow; $row++) {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                if ($row == 1) {
                    continue;
                }
                if ($row == 2) {
                    continue;
                }
                if ($row == 3) {
                    continue;
                }
                $advocates = new Tbadvocates();
                $advocates->names = $rowData [0][1];
                $advocates->practice_no = $rowData [0][2];
                $advocates->practice_area = $rowData [0][3];
                $advocates->current_law_firm = $rowData [0][4];
                $advocates->tel_no = substr($rowData [0][5], -12);
                $advocates->email = $rowData [0][6];
                $advocates->town = $rowData [0][7];

                if ($advocates->save()) {
                    echo 'success';
                } else {
                    $array_of_errors = $advocates->errors;
                    $str = '';
                    foreach ($array_of_errors as $key => $value) {
                        $str .= ' ' . implode('', $value) . ' ';
                    }
                    echo $str;
                }
            }
            //$time = date('Y-m-d');
            //rename(realpath(__DIR__ . '/..') . "/web/uploads/Recovery.xlsx", realpath(__DIR__ . '/..') . "/web/successfulimports/Recovery" . $time . \Yii::$app->user->identity->username . ".xlsx");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
