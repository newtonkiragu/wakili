<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Accounts;

/**
 * AccountsSearch represents the model behind the search form of `app\models\Accounts`.
 */
class AccountsSearch extends Accounts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userid'], 'integer'],
            [['opening_bal', 'actual_bal', 'available_bal', 'currency', 'created_at'], 'safe'],
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
        $query = Accounts::find();

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
        ]);

        $query->andFilterWhere(['like', 'opening_bal', $this->opening_bal])
            ->andFilterWhere(['like', 'actual_bal', $this->actual_bal])
            ->andFilterWhere(['like', 'available_bal', $this->available_bal])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}
