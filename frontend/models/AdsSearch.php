<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ads;

/**
 * AdsSearch represents the model behind the search form of `app\models\Ads`.
 */
class AdsSearch extends Ads
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['adname', 'imagepath','time', 'company_name', 'job_description', 'qualification', 'email', 'phone', 'address'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Ads::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'adname', $this->adname])
            ->andFilterWhere(['like', 'imagepath', $this->imagepath])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'job_description', $this->job_description])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
