<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lawfirm;

/**
 * LawfirmSearch represents the model behind the search form of `app\models\Lawfirm`.
 */
class LawfirmSearch extends Lawfirm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['town', 'building', 'county', 'floor', 'practise_areas', 'phone', 'email'], 'safe'],
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
        $query = Lawfirm::find();

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

        $query->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'building', $this->building])
            ->andFilterWhere(['like', 'county', $this->county])
            ->andFilterWhere(['like', 'floor', $this->floor])
            ->andFilterWhere(['like', 'practise_areas', $this->practise_areas])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
