<?php

namespace app\modules\psycho\models;

use app\models\Role;
use app\models\StatusTestingUser;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestingUser;

/**
 * PsychoSearch represents the model behind the search form of `app\models\TestingUser`.
 */
class TestingSearch extends TestingUser
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
        $query = TestingUser::find()->where(['status_testing_id' => StatusTestingUser::getStatusTestingId('Патологический')])->orWhere(['status_testing_id' => StatusTestingUser::getStatusTestingId('Экстремальный')]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50
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
            'user_id' => $this->user_id,
            'test_id' => $this->test_id,
            'status_testing_id' => $this->status_testing_id,
        ]);

        $query->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}
