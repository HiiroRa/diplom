<?php

namespace app\modules\blog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `app\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_article_id', 'user_id'], 'integer'],
            [['title', 'img', 'description', 'content', 'timestamp'], 'safe'],
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
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
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
            'category_article_id' => $this->category_article_id,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
