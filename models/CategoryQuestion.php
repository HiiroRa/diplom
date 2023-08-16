<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Category_question".
 *
 * @property int $id
 * @property int $title
 *
 * @property Question[] $questions
 * @property ResultTest[] $resultTests
 */
class CategoryQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Category_question';
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
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::class, ['category_question_id' => 'id']);
    }

    /**
     * Gets query for [[ResultTests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResultTests()
    {
        return $this->hasMany(ResultTest::class, ['category_question_id' => 'id']);
    }


    public static function getCategoryQuestionList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getCategoryId($title)
    {
        return static::findOne(['title' => $title])->id;
    }
}
