<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tbadvocates;

/**
 * TbadvocatesSearch represents the model behind the search form of `app\models\Tbadvocates`.
 */
class TbadvocatesSearch extends Tbadvocates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['names', 'practice_no', 'practice_area', 'current_law_firm', 'tel_no', 'email', 'town'], 'safe'],
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
        $query = Tbadvocates::find()->orderBy(['id' => SORT_DESC]);

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

        $query->andFilterWhere(['like', 'names', $this->names])
            ->andFilterWhere(['like', 'practice_no', $this->practice_no])
            ->andFilterWhere(['like', 'practice_area', $this->practice_area])
            ->andFilterWhere(['like', 'current_law_firm', $this->current_law_firm])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'town', $this->town]);

        return $dataProvider;
    }
}
