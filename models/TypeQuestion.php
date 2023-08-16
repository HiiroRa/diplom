<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Type_guestion".
 *
 * @property int $id
 * @property string $title
 *
 * @property AnswerType[] $answerTypes
 * @property Question[] $questions
 */
class TypeQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Type_question';
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
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[AnswerTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerTypes()
    {
        return $this->hasMany(AnswerType::className(), ['type_question_id' => 'id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['type_guestion_id' => 'id']);
    }
}
