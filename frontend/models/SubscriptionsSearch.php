<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subscriptions;

/**
 * SubscriptionsSearch represents the model behind the search form of `app\models\Subscriptions`.
 */
class SubscriptionsSearch extends Subscriptions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'prodid', 'duration','level_id'], 'integer'],
            [['amount', 'created_at', 'expires_at', 'status'], 'safe'],
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
        $query = Subscriptions::find();

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
            'userid' => $this->userid,
            'prodid' => $this->prodid,
            'created_at' => $this->created_at,
            'expires_at' => $this->expires_at,
            'duration' => $this->duration,
        ]);

        $query->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
