<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use DateTime;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'accessControl' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['downloadfile', 'upload', 'saveprofile'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ]
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionSaveprofile($url) {
        $staffname = Yii::$app->user->identity->username;

        $img = Yii::getAlias('@webroot') . '/assets/profile/' . $staffname . '.jpg';
        file_put_contents($img, file_get_contents($url));
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionDownloadfile($str) {


        $path = Yii::getAlias('@webroot') . "/" . ($str);
        # var_dump($path);die();
        if (file_exists($path)) {
            return \Yii::$app->response->sendFile($path);
        } else {
            throw new NotFoundHttpException("The requested file does not exist");
        }
    }

    public function actionIndex() {

        if (!Yii::$app->user->isGuest) {
            $noofadvocates = \app\models\Tbadvocates::find()->count();
            $no_of_lawfirms = \app\models\Lawfirm::find()->count();
            $no_of_useraccount = \app\models\Tbregistration::find()->count();
            $no_of_docs = \app\models\Product::find()->count();


            $query = new \yii\db\Query();
            $query->select('*')
                    ->from('transactions')
//                    ->leftJoin('tbregistration', 'transactions.userid = tbregistration.id')
                    ->limit(5)
                    ->orderBy(['transactions.id' => SORT_DESC]);

            $command = $query->createCommand();
            $alltransactions = $command->queryAll();
            
                      return $this->render('index', [
                        'noofadvocates' => $noofadvocates,
                        'no_of_lawfirms' => $no_of_lawfirms,
                        'no_of_useraccount' => $no_of_useraccount,
                        'no_of_docs' => $no_of_docs,
                        'alltransactions' => $alltransactions,
            ]);
        } else {
            $this->redirect(array('/auth/login'));
        }
    }

    public function actionDemorequest($email) {
        Yii::$app
                ->mailer
                ->compose(
                        ['html' => 'demo_form'], ['email' => $email]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo(array('mutindamike@gmail.com', 'mutinda.michael@ekenya.co.ke'))
                ->setSubject('Demo Request')
                ->send();
        echo "success";
    }

    public function Monthname($monthNum) {
        $dateObj = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        return $monthName;
    }

    public function getSeriesData($arr) {
        $myArray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($arr as $val) {
            $myArray[$val['MONTH'] - 1] = intval($val['totals']);
        }
        //var_dump($myArray);
        return $myArray;
//        die();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionStarter() {
        return $this->render('starter');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionUpload() {

        return $this->renderAjax('profileupload');
    }

}
