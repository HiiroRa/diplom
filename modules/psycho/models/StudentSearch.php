<?php

namespace app\modules\psycho\models;

use app\models\StatusTestingUser;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * StudentSearch represents the model behind the search form of `app\models\User`.
 */
class StudentSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'role_id', 'group_id'], 'integer'],
            [['name', 'surname', 'patronymic', 'email', 'login', 'password', 'auth_key'], 'safe'],
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
        $query = User::find()->joinWith('testingUsers')->where(['status_testing_id'=>[StatusTestingUser::getStatusTestingId('Патологический'), StatusTestingUser::getStatusTestingId('Экстремальный')]])->orWhere(['status_testing_id' => StatusTestingUser::getStatusTestingId('Экстремальный')]);

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
            'role_id' => $this->role_id,
            'group_id' => $this->group_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}
