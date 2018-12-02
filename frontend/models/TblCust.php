<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_cust".
 *
 * @property integer $cust_no
 * @property integer $cust_Idno
 * @property string $cust_F_Name
 * @property string $cust_M_Name
 * @property string $cust_L_Name
 * @property string $cust_Email_Address
 * @property string $cust_Telephone
 * @property string $cust_Mpesa_Telephone
 * @property string $c_Gender
 * @property string $Staffno
 * @property string $c_Marital_Status
 * @property string $designation
 */
class TblCust extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    const SCENARIO_UPDATE = 'staffupdate';

    public static function tableName() {
        return 'tbl_cust';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['designation', 'cust_Idno', 'cust_F_Name', 'cust_M_Name', 'cust_L_Name', 'cust_Email_Address', 'cust_Telephone', 'cust_Mpesa_Telephone', 'c_Gender', 'Staffno', 'c_Marital_Status'], 'required'],
            [['cust_Idno'], 'integer'],
            [['c_Gender', 'c_Marital_Status'], 'string'],
            [['cust_F_Name', 'cust_M_Name', 'cust_L_Name'], 'string', 'max' => 64],
            [['cust_Email_Address'], 'string', 'max' => 128],
            [['cust_Email_Address'], 'email'],
            [['cust_Telephone', 'cust_Mpesa_Telephone'], 'string', 'max' => 20],
            [['Staffno'], 'string', 'max' => 10],
            [['cust_Idno', 'Staffno', 'cust_Email_Address'], 'unique'],
            ['cust_Mpesa_Telephone', 'match', 'pattern' => '/^(07|254)/', 'message' => 'Only safaricom M-pesa numbers are allowed'],
            ['cust_Mpesa_Telephone', 'match', 'pattern' => '/^\d{10}$/', 'message' => 'Invalid Number size'],
            ['cust_Idno', 'match', 'pattern' => '/^\d{8}$/', 'message' => 'Invalid ID'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'cust_no' => 'Cust No',
            'cust_Idno' => 'Cust  Idno',
            'cust_F_Name' => 'First Name',
            'cust_M_Name' => ' Middle  Name',
            'cust_L_Name' => 'Last Name',
            'cust_Email_Address' => 'Email Address',
            'cust_Telephone' => 'Telephone',
            'cust_Mpesa_Telephone' => 'Mpesa  Telephone',
            'c_Gender' => 'Gender',
            'Staffno' => 'Staff no',
            'c_Marital_Status' => 'Marital  Status',
            'designation' => 'Job Designation',
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['designation', 'cust_F_Name', 'cust_M_Name', 'cust_L_Name', 'cust_Telephone', 'cust_Mpesa_Telephone', 'c_Gender', 'c_Marital_Status'];
        return $scenarios;
    }

}
