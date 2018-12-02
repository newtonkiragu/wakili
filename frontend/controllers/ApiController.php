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
use app\models\Accounts;
use app\models\Product;
use app\models\Subscriptions;
use DateTime;
use DateInterval;
use yii\helpers\ArrayHelper;

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
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;


        if ($action->id == 'register') {

            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionRegister() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $type = $request->type;
        $stepone = $request->step == 'one' ? true : false;

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';
        switch ($type) {
            case 'companyuser':
                $modelUsers = new Tbregistration();
                $modelUsers->phone = $request->phonenumber;
                $modelUsers->email = $request->email;
                $password = $request->password;
                $salt = $this->generateSalt();
                $password_hash = crypt($password, $salt);
                $modelUsers->password_hash = $password_hash;
                $modelUsers->created_at = time();
                $modelUsers->updated_at = time();
                $modelUsers->type = 4;

                $modelUsers->company_reg = $request->company_reg;
                $modelUsers->company_name = $request->company_name;
                $modelUsers->website = $request->website;
                $modelUsers->location = $request->location;


                if ($modelUsers->save()) {

                    $response['error'] = false;
                    $response['message'] = "Registration successful";
                    $response['data'] = $modelUsers;
                    $response['ads_costs'] = $this->getAdsCost();
                } else {
                    $array_of_errors = $modelUsers->errors;
                    $response['message'] = '';
                    foreach ($array_of_errors as $key => $value) {
                        $response['message'] .= ' ' . implode('', $value) . ' ';
                        $response['message'] .= '<br>';
                    }
                }



                break;
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
                    $response['ads_costs'] = $this->getAdsCost();
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

                        $response['ads_costs'] = $this->getAdsCost();
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

                            $response['ads_costs'] = $this->getAdsCost();
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

    public function getAdsCost() {
        $processedData = array();
        $selectdata = ArrayHelper::map(\app\models\Adscost::find()->asArray()->all(), 'time', 'amount');
        foreach ($selectdata as $key => $value) {

            $inner['label'] = "KES  " . $value . " for " . $key . " milliseconds";
            $inner['join'] = $key . ":" . $value;
            array_push($processedData, $inner);
        }

        return $processedData;
    }

    public function actionRegisterlawfirm() {


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
                $newLawfirm->practise_areas = $request->practise_areas;
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

    public function actionCheckbalance() {

        $postdata = file_get_contents("php://input");
//        $this->CreateLog($postdata);
        $request = json_decode($postdata);

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';
        $userphone = $request->phone;
        $recUser = Tbregistration::find()->where(['phone' => $userphone])->one();
        if ($recUser) {
            $userid = $recUser->id;
            $boolean = Accounts::find()->where(['userid' => $userid])->exists();
            if ($boolean) {
                $rec = Accounts::find()->where(['userid' => $userid])->one();
                $response['error'] = false;
                $response['message'] = $rec->actual_bal . "|" . $rec->available_bal;
                $response['subscriptions'] = $this->getSubscriptions($userid);
            } else {
                $response['error'] = false;
                $response['message'] = "00.00|00.00";
                $this->createAccount($userid);
            }
        }


//        $this->CreateLog(json_encode($response));
        return $response;
    }

    public function actionLogin() {


        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';
        $username = $request->username;
        $password = $request->password;


        $rec = Tbregistration::find()->where(['phone' => $username])->orWhere(['email' => $username])->one();
        if ($rec) {
            if ($this->checkpassword($password, $rec->password_hash)) {
                $response['error'] = false;
                $response['message'] = "Login successful";
                $response['data'] = $rec;
                if ($rec->type == 2 || $rec->type == 3) {
                    $response['payload'] = $this->getUserData($rec->type, $rec->phone);
                }
                $processedData = array();
                $selectdata = ArrayHelper::map(\app\models\Adscost::find()->asArray()->all(), 'time', 'amount');
                foreach ($selectdata as $key => $value) {

                    $inner['label'] = "KES  " . $value . " for " . $key . " milliseconds";
//                    $inner['amount'] = $value;
                    $inner['join'] = $key . ":" . $value;
                    array_push($processedData, $inner);
                }
                $response['ads_costs'] = $processedData;
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

        $faqs = Faqs::find()->all();

        return ['data' => $faqs];
    }

    public function actionConstitution() {

        $data = \app\models\Constitution::find()->all();

        return ['data' => $data];
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
        } else if (count($data) == 0) {
            $response['error'] = true;
            $response['message'] = "Sorry.No results found";
        }


        return $response;
    }

    public function createAccount($userid) {

        $account = new \app\models\Accounts();
        $account->actual_bal = "00.00";
        $account->available_bal = "00.00";
        $account->created_at = date('Y-m-d H:i:s');
        $account->currency = "KES";
        $account->opening_bal = "00.00";
        $account->userid = intval($userid);

        if ($account->save()) {

            return true;
        } else {
            $account->errors;
            return false;
        }
    }

    public function getSubscriptions($userid) {

        $records = Subscriptions::find()
                ->where(['userid' => intval($userid)])
                ->andWhere(['!=', 'type', 'PAY AS YOU GO'])
                ->all();

        $data = array();

        foreach ($records as $key => $value) {
            $exprydate = time() - strtotime($value->expires_at);
            if ($exprydate < 0) {
                if ($value->type == "PACKAGES") {
                    $name = \app\models\Packages::find()->where(['id' => $value->prodid])->one()->name;
                    array_push($data, $name);
                } else {
                    if ($value->level_id == 3) {
                        $name = \app\models\Levelthree::find()->where(['id' => $value->prodid])->one()->name;
                    } else if ($value->level_id == 2) {
                        $name = \app\models\Leveltwo::find()->where(['id' => $value->prodid])->one()->name;
                    } else if ($value->level_id == 1) {
                        $name = \app\models\Levelone::find()->where(['id' => $value->prodid])->one()->name;
                    }
                    array_push($data, $name);
                }
            }
        }

//        $sql = "SELECT * FROM subscriptions LEFT JOIN product on subscriptions.prodid = product.id where subscriptions.userid = $userid";
//        $db = Yii::$app->db;
//        $results = $db->createCommand($sql)->queryAll();
        return $data;
    }

    public function getSubscriptionsOld($userid) {

        $sql = "SELECT * FROM subscriptions LEFT JOIN product on subscriptions.prodid = product.id where subscriptions.userid = $userid";
        $db = Yii::$app->db;
        $results = $db->createCommand($sql)->queryAll();
        return $results;
    }

//    public function actionGetProducts() {
//
//        $results = Product::find()->select(['name', 'description', 'monthlyprice', 'annualprice', 'id', 'path'])->all();
//        return $results;
//    }

    public function actionGetproductstype() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $type = $request->type;
        $results = Product::find()->select(['name', 'description', 'monthlyprice', 'annualprice', 'id', 'path'])
                ->where(['level_one' => trim($type)])
                ->all();
        return $results;
    }

    public function actionChatlist() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id;
//        $sql = "SELECT count(*),sender,identifier,receiver,phone,email FROM `chats` left join  tbregistration on chats.receiver = tbregistration.id where identifier  LIKE '%$id%'  GROUP by identifier";
        $sql = "SELECT identifier FROM `chats` left join  tbregistration on chats.receiver = tbregistration.id where identifier  LIKE '%$id%'  GROUP by identifier";
        $db = Yii::$app->db;
        $results = $db->createCommand($sql)->queryAll();

        $resulsProcessed = [];
        $displayname = "";

        foreach ($results as $key => $value) {
            $arr = explode(",", $value['identifier']);
            foreach ($arr as $key1 => $valueinner) {
                if (intval($valueinner) != $id) {
                    $r = Tbregistration::find()->where(['id' => intval($valueinner)])->exists();
                    if ($r) {
                        $displayname = Tbregistration::find()->where(['id' => intval($valueinner)])->one()->phone;
                    } else {
                        $displayname = 'unknown';
                    }
                }
            }

            $value['displayname'] = $displayname;
            array_push($resulsProcessed, $value);
        }
        return $resulsProcessed;
    }

    public function actionChatMessages() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $identifier = $request->identifier;
        $sql = "SELECT * FROM `chats` where identifier  = '$identifier' order by created_at ASC";
        $db = Yii::$app->db;
        $results = $db->createCommand($sql)->queryAll();
        return $results;
    }

    public function actionChatMessagesone() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $identifier = $request->identifier;
        $sql = "SELECT * FROM `chats` where identifier  = '$identifier' order by created_at DESC LIMIT 1";
        $db = Yii::$app->db;
        $results = $db->createCommand($sql)->queryAll();
        return $results;
    }

    public function actionInsertchat() {
        $postdata = file_get_contents("php://input");
        $this->CreateLog($postdata);
        $request = json_decode($postdata);

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';

        $arr = explode(',', $request->identifier);
        $receiverId = "";
        foreach ($arr as $key => $value) {
            if ($value != $request->sender) {
                $receiverId = $value;
            }
        }

        $chat = new \app\models\Chats();
        $chat->created_at = date('Y-m-d H:i:s');
        $chat->sender = $request->sender;
        $chat->sender_image = "";
        $chat->receiver = $request->receiver;
        $chat->receiver_image = "";
        $chat->identifier = $request->identifier;
        $chat->message = $request->message;

        if ($chat->save()) {
            $response['error'] = false;
            $response['message'] = "Insert successfull";
            //send notification
            $exists = \app\models\Firebasetoken::find()->where(['userid' => intval($receiverId)])->exists();
            if ($exists) {
                $token = \app\models\Firebasetoken::find()->where(['userid' => intval($receiverId)])->one()->token;
//notify other guy
                $dataTosend = ['type' => 'single', 'title' => 'New Message', 'message' => $request->message, 'token' => $token];
                $response = $this->curlPostToURL("http://209.97.136.28:9090/Wakili-1.0/WakiliServlet", json_encode($dataTosend), 22, 22);
            }
        } else {
            $array_of_errors = $chat->errors;
            $response['message'] = '';
            foreach ($array_of_errors as $key => $value) {
                $response['message'] .= ' ' . implode('', $value) . ' ';
                $response['message'] .= '<br>';
            }
        }

        return $response;
    }

    public function actionIsSubscribed() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $prod = $request->prodid;
        $phone = $request->phone;
        $level_id = $request->level_id;
        //TODO
        //check expiry

        $userid = Tbregistration::find()->where(['phone' => $phone])->one()->id;
        $isSubscribed = Subscriptions::find()
                ->where(['userid' => $userid])
                ->andWhere(['prodid' => $prod])
                ->andWhere(['level_id' => $level_id])
                ->andWhere(['type' => 'ADVOCATE_SUBSCRIPTION'])
                ->exists();

        if ($isSubscribed) {

            $re = Subscriptions::find()
                    ->where(['userid' => $userid])
                    ->andWhere(['prodid' => $prod])
                    ->andWhere(['level_id' => $level_id])
                    ->andWhere(['type' => 'ADVOCATE_SUBSCRIPTION'])
                    ->one();
            $result = time() - strtotime($re->expires_at);

            if ($result < 0) {
                return true;
            } else {
                return false;
            }
        }


        return $isSubscribed;
    }

    public function actionIsSubscribednormaluser() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $prod = $request->prodid;
        $phone = $request->phone;
        $level_id = $request->level_id;
        //TODO
        //check expiry

        $userid = Tbregistration::find()->where(['phone' => $phone])->one()->id;
        $isSubscribed = Subscriptions::find()
                ->where(['userid' => $userid])
                ->andWhere(['type' => 'PACKAGES'])
                ->exists();

        if ($isSubscribed) {

            $re = Subscriptions::find()
                    ->where(['userid' => $userid])
                    ->andWhere(['type' => 'PACKAGES'])
                    ->one();
            $result = time() - strtotime($re->expires_at);

            if ($result < 0) {
                return true;
            } else {
                return false;
            }
        }


        return $isSubscribed;
    }

    public function actionHasvariables() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $prodid = $request->prodid;

        $hasVars = \app\models\Configurations::find()
                ->where(['doc_id' => $prodid])
                ->exists();


        if (!$hasVars) {
            $this->ChangetoPdf($prodid);
            return $hasVars;
        } else {
            return $hasVars;
        }
    }

    public function actionGetvars() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $doc_id = $request->doc_id;

        $all = \app\models\Configurations::find()
                ->select('item')
                ->where(['doc_id' => $doc_id])
                ->all();

        return $all;
    }

    public function actionProcessword() {
        $postdata = file_get_contents("php://input");
        $this->CreateLog($postdata);
        $request = json_decode($postdata);

        if (isset($request->checkoutid)) {
            $checkoutid = $request->checkoutid;
            //validate checkoutid
            $paidfor = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                    ->andWhere(['status' => '1'])
                    ->exists();

            if (!$paidfor) {

                $tokenExists = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                        ->exists();
                if ($tokenExists) {
                    $message = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                                    ->one()->message;
                    echo json_encode(['error' => true, 'message' => str_replace("[STK_CB - ]", "", $message)]);
                } else {
                    echo json_encode(['error' => true, 'message' => 'Checkout ID Missing']);
                }


                return;
            }
        }


        $path = $request->path;
        $docid = intval($request->docid);
        $extras = $request->extras;

        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                . '0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 5) as $k)
            $rand .= $seed[$k];

        $fileName = "../web/DOCUMENTS/" . $path;
        $fileName2 = "../web/DOCUMENTS/" . $rand . 'MHJ16724B1' . $path;
        $pdfname = $rand . 'MHJ16724B1' . explode('.', $path)[0] . '.pdf';

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($fileName);

        foreach ($extras as $key => $value) {
            $item = $value->item;
            $checkifExists = \app\models\Configurations::find()->where(['item' => $item])->andWhere(['doc_id' => $docid])->exists();
            if ($checkifExists) {
                $res = \app\models\Configurations::find()->where(['item' => $item])->andWhere(['doc_id' => $docid])->one();
                $templateProcessor->setValue($res->value, $value->answer);
            }
        }
        $templateProcessor->setValue('year', date('Y'));


        $templateProcessor->saveAs($fileName2);
        exec('sudo /usr/bin/unoconv ' . $fileName2);

        echo json_encode(['error' => false, 'message' => 'File written!', 'filename' => $pdfname]);
    }

    public function ChangetoPdf($docid) {

        $path = \app\models\Levelthree::find()->where(['id' => $docid])->one()->path;
        $fileName = "../web/DOCUMENTS/" . $path;
        $pdfname = explode('.', $path)[0] . '.pdf';

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($fileName);

        $templateProcessor->saveAs($fileName);

        exec('sudo /usr/bin/unoconv ' . $fileName);
    }

    public function actionUpdatetoken() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $userid = strval($request->userid);
        $token = $request->token;

        $response = [];
        $response['error'] = true;
        $response['message'] = 'An error occured';

        $exists = \app\models\Firebasetoken::find()->where(['userid' => $userid])->exists();

        if ($exists) {
            $model = \app\models\Firebasetoken::find()->where(['userid' => $userid])->one();
            $model->token = $token;

            if ($model->save()) {
                $response['error'] = false;
                $response['message'] = "TOKEN successfull";
            } else {
                $array_of_errors = $model->errors;
                $response['message'] = '';
                foreach ($array_of_errors as $key => $value) {
                    $response['message'] .= ' ' . implode('', $value) . ' ';
                    $response['message'] .= '<br>';
                }
            }
        } else {
            $model = new \app\models\Firebasetoken();
            $model->userid = $userid;
            $model->token = $token;

            if ($model->save()) {
                $response['error'] = false;
                $response['message'] = "TOKEN successfull";
            } else {
                $array_of_errors = $model->errors;
                $response['message'] = '';
                foreach ($array_of_errors as $key => $value) {
                    $response['message'] .= ' ' . implode('', $value) . ' ';
                    $response['message'] .= '<br>';
                }
            }
        }


        return $response;
    }

    public function curlPostToURL($serviceURL, $payloadRequest, $connectionTimeout, $readTimeout) {
        $header = array(
            "Content-type: application/json;charset=ISO-8859-1",
            "Accept: application/json",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($payloadRequest),
        );

        //echo $payloadRequest;

        $channel = curl_init();
        curl_setopt($channel, CURLOPT_URL, $serviceURL);
        curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, $connectionTimeout);
        curl_setopt($channel, CURLOPT_TIMEOUT, $readTimeout);
        curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($channel, CURLOPT_HTTPHEADER, $header);
        curl_setopt($channel, CURLOPT_POSTFIELDS, "$payloadRequest");
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($channel, CURLOPT_VERBOSE, true);

        $response = curl_exec($channel);
        if ($response === null) {
            $err = 'Curl error: ' . curl_error($channel);
            curl_close($channel);

            $err = array(
                'status' => 99,
                'statusDescription' => "ERROR! " . "Curl error: " . curl_error($channel)
            );

            return json_encode($err);
        } else {
            curl_close($channel);
            return $response;
        }
    }

    public function actionMpesaRequest() {
        $payloadRequest = file_get_contents("php://input");
        $val = json_decode($payloadRequest);
        $token = $val->token;
        $amount = $val->Amount;
        $phone = $val->PartyA;

        //check if has pending request
        $haspending = \app\models\Transactions::find()
                ->where(['phone' => $phone])
                ->andWhere(['status' => '0'])
                ->andWhere(['amount' => $amount])
                ->exists();

        if ($haspending) {
            $response = [];
            $response['ResponseCode'] = "99";
            $response['message'] = "You have a pending transaction";
            return json_encode($response);
        }
        $header = array(
            "Content-type: application/json;charset=ISO-8859-1",
            "Accept: application/json",
            "Authorization: Bearer " . $token
        );

        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_VERBOSE, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "$payloadRequest");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $curl_response = curl_exec($curl);
        $decodedRes = json_decode($curl_response);

        if ($decodedRes->ResponseCode == "0") {
            $trans = new \app\models\Transactions;
            $trans->amount = strval($amount);
            $trans->date = '';
            $trans->desc = $decodedRes->ResponseDescription;
            $trans->ref = '';
            $trans->phone = strval($phone);
            $trans->userid = '';
            $trans->status = '0';
            $trans->checkoutrequestid = $decodedRes->CheckoutRequestID;
            $trans->message = $decodedRes->ResponseDescription;
            $trans->merchantid = $decodedRes->MerchantRequestID;
            if ($trans->save()) {
                return $curl_response;
            } else {
                $array_of_errors = $trans->errors;
                $str = '';
                foreach ($array_of_errors as $key => $value) {
                    $str .= ' ' . implode('', $value) . ' ';
                }

                $response = [];
                $response['ResponseCode'] = "99";
                $response['message'] = $str;
                return json_encode($response);
            }
        }
    }

    public function actionGettoken() {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode('peBCwaQrPfiSqGZVBnDRouSvKCt80LGx:Nt66ljDuVLQbWrfh');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_VERBOSE, false);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function actionStkcallback() {
        $postdata = file_get_contents("php://input");
        $this->CreateLog($postdata);
        $jsonArrayBody = json_decode($postdata, true);

        $resultCode = $jsonArrayBody['Body']['stkCallback']['ResultCode'];
        $checkoutid = $jsonArrayBody['Body']['stkCallback']['CheckoutRequestID'];
        $description = $jsonArrayBody['Body']['stkCallback']['ResultDesc'];
        if (!$resultCode == 0) {
            $trans = \app\models\Transactions::find()
                    ->where(['checkoutrequestid' => $checkoutid])
                    ->one();

            $trans->desc = $description;
            $trans->message = $description;
            $trans->status = "2";
            $trans->save();
            return;
        }
        $CallbackMetadata = $jsonArrayBody['Body']['stkCallback']['CallbackMetadata']['Item'];

        $amount = "";
        $ref = "";
        $date = "";
        $phone = "";

        foreach ($CallbackMetadata as $key => $value) {
            if ($value['Name'] == 'Amount') {
                $amount = $value['Value'];
            }
            if ($value['Name'] == 'MpesaReceiptNumber') {
                $ref = $value['Value'];
            }
            if ($value['Name'] == 'TransactionDate') {
                $date = $value['Value'];
            }
            if ($value['Name'] == 'PhoneNumber') {
                $phone = $value['Value'];
            }
        }
        $processedPhone = '0' . substr($phone, -9);
        $recUser = Tbregistration::find()->where(['phone' => $processedPhone])->one();
        if ($recUser) {
            $userid = $recUser->id;

            $recAcc = Accounts::find()->where(['userid' => $userid])->one();
            if ($recAcc) {


                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $currentbal = $recAcc->actual_bal;
                    $totalbal = $currentbal + $amount;
                    $recAcc->actual_bal = strval($totalbal);
                    $recAcc->available_bal = strval($totalbal);

                    $trans = \app\models\Transactions::find()
                            ->where(['checkoutrequestid' => $checkoutid])
                            ->one();
                    $trans->amount = strval($amount);
                    $trans->date = strval($date);
                    $trans->desc = $description;
                    $trans->message = $description;
                    $trans->ref = $ref;
                    $trans->phone = strval($phone);
                    $trans->status = "1";
                    $trans->userid = $userid;
                    if ($recAcc->save() && $trans->save()) {

                        $transaction->commit();
                        $this->CreateLog("commit successful...");
                    } else {
                        $array_of_errors1 = $recAcc->errors;
                        $array_of_errors2 = $trans->errors;
                        $arr_main = array_merge($array_of_errors1, $array_of_errors2);
                        $response = '';

                        foreach ($arr_main as $key => $value) {
                            $response .= ' ' . implode('', $value) . ' ';
                            $response .= '--';
                        }
                        $mes = $response;
                        $this->CreateLog($response);
                    }
                } catch (\Exception $e) {
                    $this->CreateLog($e->getMessage());
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $this->CreateLog($e->getMessage());
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
    }

    public function actionSubscribe() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);

        $response = [];
        $response['error'] = true;
        $response['title'] = '';
        $response['message'] = 'An error occured';

        $userid = intval($data->userid);
        $prodid = $data->prodid;
        $level_id = $data->level_id;
        $amount = $data->amount;
        $duration = $data->duration;
        $type = $data->type;

        if (isset($data->checkoutid)) {
            $checkoutid = $data->checkoutid;
            //validate checkoutid
            $paidfor = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                    ->andWhere(['status' => '1'])
                    ->exists();

            if (!$paidfor) {

                $tokenExists = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                        ->exists();
                if ($tokenExists) {
                    $message = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                                    ->one()->message;
                    echo json_encode(['error' => true, 'message' => str_replace("[STK_CB - ]", "", $message)]);
                } else {
                    echo json_encode(['error' => true, 'message' => 'Checkout ID Missing']);
                }


                return;
            }
        }else{
            echo json_encode(['error' => true, 'message' => 'Checkout id not found']);
            return;
        }

        //subscribe
        $transaction = Yii::$app->db->beginTransaction();
        try {

            $model = new Subscriptions();
            $model->amount = $amount;
            $model->userid = $userid;
            $model->created_at = date('Y-m-d H:i:s');
            $model->duration = $duration == 'Monthly' ? 1 : 12;
            $model->prodid = intval($prodid);

            if ($duration == 'Monthly') {
                $date = new DateTime($model->created_at);
                $date->add(new DateInterval('P1M'));
            } else {
                $date = new DateTime($model->created_at);
                $date->add(new DateInterval('P12M'));
            }

            $model->expires_at = $date->format('Y-m-d H:i:s');
            $model->status = 'Active';
            $model->level_id = $level_id;
            $model->type = $type;


            if ($model->save()) {


                $response['error'] = false;
                $response['message'] = 'Subscription Successfull';
                $transaction->commit();
            } else {
                $array_of_errors = $model->errors;
                $str = '';
                foreach ($array_of_errors as $key => $value) {
                    $str .= ' ' . implode('', $value) . ' ';
                }
                $response['error'] = true;
                $response['message'] = $str;
            }
        } catch (\Exception $e) {
            $transaction->rollback();
        } catch (\Throwable $e) {
            $transaction->rollback();
        }


        return $response;




        /*
         * check if user account has enough money
         * if so create subsription else return error
         */
    }

    public function CreateLog($message) {
        date_default_timezone_set("Africa/Nairobi");

        $destinationPath = '/var/log/applications/wakiliapi/' . date("Y-m-d"); // upload path
//        $destinationPath = __DIR__  .'/'. date("Y-m-d"); // upload path
        //print_r($destinationPath);die();
        $time = date("H:i:sa");

        $file = 'requests.txt';
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $data = PHP_EOL . $time . " : " . $message;
        // using the FILE_APPEND flag to append the content to the end of the file
        // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
        file_put_contents($destinationPath . '/' . $file, $data, FILE_APPEND | LOCK_EX);
    }

    public function actionCheckifadvocatecanchat() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);
        $phone = $data->tel_no;

        $response['error'] = true;
        $response['message'] = 'not found';

        $recTbreg = Tbregistration::find()->where(['phone' => $phone])->exists();
        if ($recTbreg) {
            $recTbreg = Tbregistration::find()->where(['phone' => $phone])->one();
            $userid = $recTbreg->id;
            $recFirebase = \app\models\Firebasetoken::find()->where(['userid' => $userid])->exists();
            if ($recFirebase) {
                $response['error'] = false;
                $response['message'] = 'good';
                $response['userid'] = $userid;
                return $response;
            }
        }
        return $response;
    }

    public function actionGetdashboarddata() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);
        $usertype = $data->usertype;

        $response['error'] = true;
        $response['message'] = 'an error occured';

        $levelZeroItems = \app\models\Levelzero::find()->where(['usertype' => $usertype])->asArray()->all();

        $allAds = \app\models\Ads::find()->limit(10)->orderBy(['id' => SORT_DESC])->all();

        $response['error'] = false;
        $response['message'] = $levelZeroItems;
        $response['ads'] = $allAds;
        return $response;

        return $response;
    }

    public function actionLevelzero() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);
        $usertype = $data->usertype;

        $response['error'] = true;
        $response['message'] = 'No data found';

        $allrecords = \app\models\Levelzero::find()->where(['usertype' => $usertype])->all();

        if ($allrecords) {
            $response['error'] = false;
            $response['message'] = $allrecords;
            return $response;
        }
        return $response;
    }

    public function actionSubscribeparent() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);
        $level_zero_id = $data->level_zero_id;
        $id = $data->id;

        $allrecords = \app\models\Levelone::find()
                ->where(['level_zero_id' => $level_zero_id])
                ->where(['id' => $id])
                ->all();

        if ($allrecords) {
            $response['error'] = false;
            $response['message'] = $allrecords;
            return $response;
        } else {
            $response['error'] = false;
            $response['message'] = [];
            return $response;
        }
        return $response;
    }

    public function actionLevelone() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);
        $level_zero_id = $data->level_zero_id;

        $allrecords = \app\models\Levelone::find()->where(['level_zero_id' => $level_zero_id])->all();

        if ($allrecords) {
            $response['error'] = false;
            $response['message'] = $allrecords;
            return $response;
        } else {
            $response['error'] = false;
            $response['message'] = [];
            return $response;
        }
        return $response;
    }

    public function actionGetproducts() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);

        $allrecords = \app\models\Levelone::find()->all();

        if ($allrecords) {
            $response['error'] = false;
            $response['message'] = $allrecords;
            return $response;
        } else {
            $response['error'] = false;
            $response['message'] = [];
            return $response;
        }
        return $response;
    }

    public function actionLeveltwo() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);
        $level_one_id = $data->level_one_id;

        $allrecords = \app\models\Leveltwo::find()->where(['level_one_id' => $level_one_id])->all();

        if ($allrecords) {
            $response['error'] = false;
            $response['message'] = $allrecords;
            return $response;
        } else {
            $response['error'] = false;
            $response['message'] = [];
            return $response;
        }
        return $response;
    }

    public function actionLevelthree() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);
        $level_two_id = $data->level_two_id;

        $allrecords = \app\models\Levelthree::find()->where(['level_two_id' => $level_two_id])->all();

        if ($allrecords) {
            $response['error'] = false;
            $response['message'] = $allrecords;
            return $response;
        } else {
            $response['error'] = false;
            $response['message'] = [];
            return $response;
        }
        return $response;
    }

    public function actionCreateadvert() {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata);

        $checkoutid = $data->checkoutid;
        //validate checkoutid
        $paidfor = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                ->andWhere(['status' => '1'])
                ->exists();

        if (!$paidfor) {

            $message = \app\models\Transactions::find()->where(['checkoutrequestid' => $checkoutid])
                            ->one()->message;
            echo json_encode(['error' => true, 'message' => str_replace("[STK_CB - ]", "", $message)]);
            return;
        }

        $img = $data->image;

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $dataImage = base64_decode($img);
        $t = time();
        $imageName = 'Advert_' . $t . '.jpg';
        $file = '../web/adverts/' . $imageName;
        $success = file_put_contents($file, $dataImage);

        $advertModel = new \app\models\Ads;
        $advertModel->address = $data->address;
        $advertModel->company_name = $data->company_name;
        $advertModel->email = $data->email;
        $advertModel->phone = $data->phone;
        $advertModel->imagepath = $imageName;
        $advertModel->adname = $imageName;
        $advertModel->time = $data->time;


        $advertModel->type = $data->type;
        if (isset($data->content)) {
            $advertModel->content = $data->content;
        }

        if (isset($data->job_description)) {
            $advertModel->job_description = $data->job_description;
        }

        if (isset($data->qualification)) {
            $advertModel->qualification = $data->qualification;
        }



        if ($advertModel->save()) {
            $response['error'] = false;
            $response['message'] = "Advert created successfully";
        } else {
            $array_of_errors = $advertModel->errors;
            $response['message'] = '';
            foreach ($array_of_errors as $key => $value) {
                $response['message'] .= ' ' . implode('', $value) . ' ';
                $response['message'] .= '<br>';
            }
            $response['error'] = true;
        }

        return $response;
    }

    public function actionGetpackages() {
        $allPackages = \app\models\Packages::find()->all();

        if ($allPackages) {
            $response['error'] = false;
            $response['message'] = $allPackages;
        } else {
            $response['error'] = false;
            $response['message'] = [];
        }
        return $response;
    }

}
