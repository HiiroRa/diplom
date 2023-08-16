<?php

namespace app\modules\profile\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestingUser;
use Yii;

/**
 * ProfileSearch represents the model behind the search form of `app\models\TestingUser`.
 */
class ProfileSearch extends TestingUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'test_id', 'status_testing_id'], 'integer'],
            [['date', 'auth_key'], 'safe'],
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
        $query = TestingUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
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
            'date' => $this->date,
            'user_id' => Yii::$app->user->id,
            'test_id' => $this->test_id,
            'status_testing_id' => $this->status_testing_id,
        ]);

        $query->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}