<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Answer_question".
 *
 * @property int $id
 * @property string $title
 * @property int $value
 * @property int $question_id
 *
 * @property Question $question
 */
class AnswerQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Answer_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'value', 'question_id'], 'required'],
            [['value', 'question_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::class, 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'value' => 'Значение',
            'question_id' => '№ вопроса',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::class, ['id' => 'question_id']);
    }
}
