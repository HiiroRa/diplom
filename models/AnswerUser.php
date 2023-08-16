<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Answer_user".
 *
 * @property int $id
 * @property int $testing_user_id
 * @property int $question_id
 * @property int $answer_value
 *
 * @property Question $question
 * @property TestingUser $testingUser
 */
class AnswerUser extends \yii\db\ActiveRecord
{



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Answer_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_key', 'question_id', 'answer_value'], 'required'],
            [['question_id', 'answer_value'], 'integer'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auth_key' => 'auth_key',
            'question_id' => 'Question ID',
            'answer_value' => 'Answer Value',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * Gets query for [[TestingUser]].
     *
     * @return \yii\db\ActiveQuery
     */

}
