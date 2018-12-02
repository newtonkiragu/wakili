<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leveltwo;

/**
 * LeveltwoSearch represents the model behind the search form of `app\models\Leveltwo`.
 */
class LeveltwoSearch extends Leveltwo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'level_one_id'], 'integer'],
            [['name', 'description', 'path', 'monthlyprice', 'annualprice', 'is_terminal'], 'safe'],
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
        $query = Leveltwo::find();

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
            'level_one_id' => $this->level_one_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'monthlyprice', $this->monthlyprice])
            ->andFilterWhere(['like', 'annualprice', $this->annualprice])
            ->andFilterWhere(['like', 'is_terminal', $this->is_terminal]);

        return $dataProvider;
    }
}
