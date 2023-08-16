<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Testing_user".
 *
 * @property int $id
 * @property string $date
 * @property int $user_id
 * @property int $test_id
 * @property int $result
 *
 * @property AnswerUser[] $answerUsers
 * @property Test $test
 * @property User $user
 */
class TestingUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Testing_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['user_id', 'test_id', 'status_testing_id'], 'required'],
            [['user_id', 'test_id', 'status_testing_id'], 'integer'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::class, 'targetAttribute' => ['test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_testing_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusTestingUser::class, 'targetAttribute' => ['status_testing_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'user_id' => 'User ID',
            'test_id' => 'Тест',
            'status_testing_id' => 'Статус',
        ];
    }

    /**
     * Gets query for [[AnswerUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerUsers()
    {
        return $this->hasMany(AnswerUser::class, ['testing_user_id' => 'id']);
    }

    /**
     * Gets query for [[StatusTesting]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusTesting()
    {
        return $this->hasOne(StatusTestingUser::class, ['id' => 'status_testing_id']);
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


}
