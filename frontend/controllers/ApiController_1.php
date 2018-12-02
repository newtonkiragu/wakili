<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\Cors;
use yii\filters\auth\HttpBearerAuth;
use app\models\Tbregistration;
use app\models\Tbadvocates;
use app\models\Lawfirm;
use app\models\Faqs;

class ApiController extends \yii\rest\Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {

        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
            ],
        ];


        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'register' => ['POST'],
                'login' => ['POST'],
                'registerlawfirm' => ['POST'],
            ],
        ];

        return $behaviors;
    }

    public function beforeAction($action) {

        if ($action->id == 'register') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionRegister() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $type = $request->type;
        $stepone = $request->step == 'one' ? true : false;

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';
        switch ($type) {
            case 'generaluser':
                $modelUsers = new Tbregistration();
                $modelUsers->phone = $request->phonenumber;
                $modelUsers->email = $request->email;
                $password = $request->password;
                $salt = $this->generateSalt();
                $password_hash = crypt($password, $salt);
                $modelUsers->password_hash = $password_hash;
                $modelUsers->created_at = time();
                $modelUsers->updated_at = time();
                $modelUsers->type = 1;
                if ($modelUsers->save()) {
                    $response['error'] = false;
                    $response['message'] = "Registration successful";
                    $response['data'] = $modelUsers;
                } else {
                    $array_of_errors = $modelUsers->errors;
                    $response['message'] = '';
                    foreach ($array_of_errors as $key => $value) {
                        $response['message'] .= ' ' . implode('', $value) . ' ';
                        $response['message'] .= '<br>';
                    }
                }

                break;
            case 'advocateuser':

                //check if exists in tbadvocate create in tbregistration only else create in both tables
                $exists = Tbadvocates::find()->where(['practice_no' => $request->practice_no])->exists();

                if ($exists && $stepone) {
                    $rec = Tbadvocates::find()->where(['practice_no' => $request->practice_no])->one();
                    $modelUsers = new Tbregistration();
                    $modelUsers->phone = $rec->tel_no;
                    $modelUsers->email = $rec->email;
                    $password = $request->password;
                    $salt = $this->generateSalt();
                    $password_hash = crypt($password, $salt);
                    $modelUsers->password_hash = $password_hash;
                    $modelUsers->created_at = time();
                    $modelUsers->updated_at = time();
                    $modelUsers->type = 2;
                    if ($modelUsers->save()) {
                        $response['error'] = false;
                        $response['message'] = "Registration successful";
                        $response['data'] = $modelUsers;
                        $response['payload'] = $this->getUserData($modelUsers->type, $modelUsers->phone);
                    } else {
                        $array_of_errors = $modelUsers->errors;
                        $response['message'] = '';
                        foreach ($array_of_errors as $key => $value) {
                            $response['message'] .= ' ' . implode('', $value) . ' ';
                            $response['message'] .= '<br>';
                        }
                    }
                } else if (!$exists && $stepone) {
                    $response['message'] = "Account not found in database.Please update details to continue";
                } else if (!$exists && !$stepone) {
                    $db = \Yii::$app->db;
                    $transaction = $db->beginTransaction();
                    try {
                        $newAdvocate = new Tbadvocates();
                        $newAdvocate->names = $request->names;
                        $newAdvocate->email = $request->email;
                        $newAdvocate->practice_area = $request->practice_area;
                        $newAdvocate->tel_no = $request->phonenumber;
                        $newAdvocate->town = $request->town;
                        $newAdvocate->practice_no = $request->practice_no;
                        $newAdvocate->current_law_firm = $request->current_law_firm;
                        //tbregistration

                        $modelUsers = new Tbregistration();
                        $modelUsers->phone = $request->phonenumber;
                        $modelUsers->email = $request->email;
                        $password = $request->password;
                        $salt = $this->generateSalt();
                        $password_hash = crypt($password, $salt);
                        $modelUsers->password_hash = $password_hash;
                        $modelUsers->created_at = time();
                        $modelUsers->updated_at = time();
                        $modelUsers->type = 2;

                        if ($newAdvocate->save() && $modelUsers->save()) {
                            $response['error'] = false;
                            $response['message'] = "Registration successful";
                            $response['data'] = $modelUsers;
                            $response['payload'] = $this->getUserData($modelUsers->type, $modelUsers->phone);
                            $transaction->commit();
                        } else {
                            $response['message'] = '';
                            $array_of_errors1 = $newAdvocate->errors;
                            $array_of_errors2 = $modelUsers->errors;
                            $arr_main = array_merge($array_of_errors1, $array_of_errors2);

                            foreach ($arr_main as $key => $value) {
                                $response['message'] .= ' ' . implode('', $value) . ' ';
                                $response['message'] .= '<br>';
                            }
                        }
                    } catch (\Exception $e) {
                        $transaction->rollback();
                    } catch (\Throwable $e) {
                        $transaction->rollback();
                    }
                } else {
                    
                }
                break;
            default:
                break;
        }
        return $response;
    }

    public function actionRegisterlawfirm() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $stepone = $request->step == 'one' ? true : false;

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';

        //check if exists in tbadvocate create in tbregistration only else create in both tables
        $exists = Lawfirm::find()->where(['reg_no' => $request->reg_no])->exists();

        if ($exists && $stepone) {
            $rec = Lawfirm::find()->where(['reg_no' => $request->reg_no])->one();
            $modelUsers = new Tbregistration();
            $modelUsers->phone = $rec->phone;
            $modelUsers->email = $rec->email;
            $password = $request->password;
            $salt = $this->generateSalt();
            $password_hash = crypt($password, $salt);
            $modelUsers->password_hash = $password_hash;
            $modelUsers->created_at = time();
            $modelUsers->updated_at = time();
            $modelUsers->type = 3;
            if ($modelUsers->save()) {
                $response['error'] = false;
                $response['message'] = "Registration successful";
                $response['data'] = $modelUsers;
                $response['payload'] = $this->getUserData($modelUsers->type, $modelUsers->phone);
            } else {
                $array_of_errors = $modelUsers->errors;
                $response['message'] = '';
                foreach ($array_of_errors as $key => $value) {
                    $response['message'] .= ' ' . implode('', $value) . ' ';
                    $response['message'] .= '<br>';
                }
            }
        } else if (!$exists && $stepone) {
            $response['message'] = "Details not found in database.Please update details to continue";
        } else if (!$exists && !$stepone) {
            $db = \Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $newLawfirm = new Lawfirm();
                $newLawfirm->town = $request->town;
                $newLawfirm->reg_no = $request->reg_no;
                $newLawfirm->building = $request->building;
                $newLawfirm->county = $request->county;
                $newLawfirm->floor = isset($request->floor) ? $request->floor : '-';
                $newLawfirm->email = $request->email;
                $newLawfirm->phone = $request->phone;
                $newLawfirm->practise_areas = 'Criminal law,Family law';
                $newLawfirm->name = $request->name;
                //tbregistration

                $modelUsers = new Tbregistration();
                $modelUsers->phone = $request->phone;
                $modelUsers->email = $request->email;
                $password = $request->password;
                $salt = $this->generateSalt();
                $password_hash = crypt($password, $salt);
                $modelUsers->password_hash = $password_hash;
                $modelUsers->created_at = time();
                $modelUsers->updated_at = time();
                $modelUsers->type = 3;

                if ($newLawfirm->save() && $modelUsers->save()) {
                    $response['error'] = false;
                    $response['message'] = "Registration successful";
                    $response['data'] = $modelUsers;
                    $response['payload'] = $this->getUserData($modelUsers->type, $modelUsers->phone);
                    $transaction->commit();
                } else {
                    $response['message'] = '';
                    $array_of_errors1 = $newLawfirm->errors;
                    $array_of_errors2 = $modelUsers->errors;
                    $arr_main = array_merge($array_of_errors1, $array_of_errors2);

                    foreach ($arr_main as $key => $value) {
                        $response['message'] .= ' ' . implode('', $value) . ' ';
                        $response['message'] .= '<br>';
                    }
                }
            } catch (\Exception $e) {
                $transaction->rollback();
            } catch (\Throwable $e) {
                $transaction->rollback();
            }
        } else {
            
        }

        return $response;
    }

    public function actionLogin() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';
        $type = intval($request->type);
        $username = $request->username;
        $password = $request->password;


        $rec = Tbregistration::find()->where(['phone' => $username])->orWhere(['email' => $username])->andWhere(['type' => $type])->one();
        if ($rec) {
            if ($this->checkpassword($password, $rec->password_hash)) {
                $response['error'] = false;
                $response['message'] = "Login successful";
                $response['data'] = $rec;
                if ($rec->type == 2 || $rec->type == 3) {
                    $response['payload'] = $this->getUserData($rec->type, $rec->phone);
                }
            } else {
                $response['message'] = "Invalid Credentials";
            }
        } else {
            $response['message'] = "Account does not Exist";
        }


        return $response;
    }

    protected function generateSalt($cost = 13) {
        $cost = (int) $cost;
        if ($cost < 4 || $cost > 31) {
            throw new InvalidParamException('Cost must be between 4 and 31.');
        }

        // Get a 20-byte random string
        $rand = 'bhaj7686!@*&!#*djhwdsdsdsd';
        // Form the prefix that specifies Blowfish (bcrypt) algorithm and cost parameter.
        $salt = sprintf("$2y$%02d$", $cost);
        // Append the random salt data in the required base64 format.
        $salt .= str_replace('+', '.', substr(base64_encode($rand), 0, 22));

        return $salt;
    }

    public function checkpassword($password, $pass_hash) {
        $test = crypt($password, $pass_hash);
        if ($pass_hash == $test) {
            return true;
        } else {
            return false;
        }
    }

    public function actionFaqs() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $faqs = Faqs::find()->all();

        return ['data' => $faqs];
    }

    public function getUserData($type, $param) {
        $data = null;
        switch ($type) {
            case 2:
                $data = Tbadvocates::find()->where(['email' => $param])->orWhere(['tel_no' => $param])->one();
                break;
            case 3:
                $data = Lawfirm::find()->where(['email' => $param])->orWhere(['phone' => $param])->one();
                break;
            default:

                break;
        }
        return $data;
    }

    public function actionSearchadvocate() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';
        $criteria = trim($request->criteria);
        $params = trim($request->params);

        $data = Tbadvocates::find()
                ->andFilterWhere(['like', $criteria, $params])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        $count = count($data);
        if ($count > 0) {
            $response['error'] = false;
            $response['message'] = "info found";
            $response['data'] = $data;
        }else if(count($data) == 0){
            $response['error'] = true;
            $response['message'] = "Sorry.No results found";
        }
        

        return $response;
    }
    
    

}
