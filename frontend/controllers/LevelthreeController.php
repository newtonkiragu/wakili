<?php

namespace frontend\controllers;

use Yii;
use app\models\Levelthree;
use app\models\LevelthreeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LevelthreeController implements the CRUD actions for Levelthree model.
 */
class LevelthreeController extends Controller {

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
     * Lists all Levelthree models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LevelthreeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Levelthree model.
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
     * Creates a new Levelthree model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Levelthree();

        if ($model->load(Yii::$app->request->post())) {

            $fileItem = UploadedFile::getInstance($model, 'fileItem');

            if ($fileItem != NULL) {
                $filename = $fileItem->baseName . "." . $fileItem->extension;
                $filename = str_replace(" ", "_", $filename);
                $model->path = $filename;
                $fileItem->saveAs('DOCUMENTS/' . $filename);
            }
            $model->is_terminal = "1";

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
     * Updates an existing Levelthree model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->setScenario(Levelthree::SCENARIO_UPDATE);

        if ($model->load(Yii::$app->request->post())) {
            $fileItem = UploadedFile::getInstance($model, 'fileItem');

            if ($fileItem != NULL) {
                $filename = $fileItem->baseName . "." . $fileItem->extension;
                $filename = str_replace(" ", "_", $filename);
                $model->path = $filename;
                $fileItem->saveAs('DOCUMENTS/' . $filename);
            }
            $model->is_terminal = "1";

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
            ]);
        }
    }

    /**
     * Deletes an existing Levelthree model.
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
     * Finds the Levelthree model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Levelthree the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Levelthree::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
