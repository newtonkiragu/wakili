<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblCust;

/**
 * TblCustSearch represents the model behind the search form about `app\models\TblCust`.
 */
class TblCustSearch extends TblCust
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cust_no', 'cust_Idno'], 'integer'],
            [['designation','cust_F_Name', 'cust_M_Name', 'cust_L_Name', 'cust_Email_Address', 'cust_Telephone', 'cust_Mpesa_Telephone', 'c_Gender', 'Staffno', 'c_Marital_Status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TblCust::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cust_no' => $this->cust_no,
            'cust_Idno' => $this->cust_Idno,
        ]);

        $query->andFilterWhere(['like', 'cust_F_Name', $this->cust_F_Name])
            ->andFilterWhere(['like', 'cust_M_Name', $this->cust_M_Name])
            ->andFilterWhere(['like', 'cust_L_Name', $this->cust_L_Name])
            ->andFilterWhere(['like', 'cust_Email_Address', $this->cust_Email_Address])
            ->andFilterWhere(['like', 'cust_Telephone', $this->cust_Telephone])
            ->andFilterWhere(['like', 'cust_Mpesa_Telephone', $this->cust_Mpesa_Telephone])
            ->andFilterWhere(['like', 'c_Gender', $this->c_Gender])
            ->andFilterWhere(['like', 'Staffno', $this->Staffno])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'c_Marital_Status', $this->c_Marital_Status]);

        return $dataProvider;
    }
}
