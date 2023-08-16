<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Category_article".
 *
 * @property int $id
 * @property string $title
 *
 * @property Article[] $articles
 */
class CategoryArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Category_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер категории',
            'title' => 'Название',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['category_article_id' => 'id']);
    }

    public static function getCategoryArticleList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getCategoryArticleNeme($id)
    {
        return static::findOne(['id' => $id])->title;
    }
}
