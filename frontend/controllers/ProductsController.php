<?php

namespace frontend\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Product model.
 */
class ProductsController extends Controller {

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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /*
         * Get attributes label and format well
         */
        $ignoreThis = [];
        $ignoreThis = ['path'];
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
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Product();
        $model2 = new \app\models\Leveltwo();

        if ($model->load(Yii::$app->request->post())) {
//            $model->path = "https://api.mutindamike.com/pdf.pdf";
            $fileItem = UploadedFile::getInstance($model, 'fileItem');

            if ($fileItem != NULL) {
                $filename = $fileItem->baseName . "." . $fileItem->extension;
                $filename = str_replace(" ", "_", $filename);
                $model->path = $filename;
                $fileItem->saveAs('DOCUMENTS/' . $filename);
            }

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
                        'model2' => $model2,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->setScenario(Product::SCENARIO_UPDATE);
        $model2 = new \app\models\Leveltwo();


        if ($model->load(Yii::$app->request->post())) {

            $fileItem = UploadedFile::getInstance($model, 'fileItem');

            if ($fileItem != NULL) {
                $filename = $fileItem->baseName . "." . $fileItem->extension;
                $filename = str_replace(" ", "_", $filename);
                $model->path = $filename;
                $fileItem->saveAs('DOCUMENTS/' . $filename);
            }

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
            return $this->render('update', [
                        'model' => $model,
                        'model2' => $model2,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLists($id) {
        $countPosts = \app\models\Leveltwo::find()
                ->where(['level_one' => $id])
                ->count();

        $posts = \app\models\Leveltwo::find()
                ->where(['level_one' => $id])
                ->orderBy('level_two ASC')
                ->all();

        if ($countPosts > 0) {
            foreach ($posts as $post) {
                echo "<option value='" . $post->level_two . "'>" . $post->level_two . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
