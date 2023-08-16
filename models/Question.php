<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Question".
 *
 * @property int $id
 * @property string $title
 * @property int $category_question_id
 * @property int $test_id
 * @property int $count_answers
 *
 * @property AnswerQuestion[] $answerQuestions
 * @property AnswerUser[] $answerUsers
 * @property CategoryQuestion $categoryQuestion
 * @property Test $test
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category_question_id', 'test_id'], 'required'],
            [['category_question_id','additional_category_question', 'test_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['category_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryQuestion::class, 'targetAttribute' => ['category_question_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::class, 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'category_question_id' => 'Категория вопроса',
            'additional_category_question' => 'Дополнительная категория вопроса',
            'test_id' => 'Название теста',
        ];
    }

    /**
     * Gets query for [[AnswerQuestions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerQuestions()
    {
        return $this->hasMany(AnswerQuestion::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[AnswerUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerUsers()
    {
        return $this->hasMany(AnswerUser::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[CategoryQuestion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryQuestion()
    {
        return $this->hasOne(CategoryQuestion::class, ['id' => 'category_question_id']);
    }

    /**
     * Gets query for [[Test]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::class, ['id' => 'test_id']);
    }

    public static function getQuestionList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getTitleQuestion($id)
    {
        return static::findOne(['id' => $id])->title;
    }

}
