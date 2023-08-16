<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Status_testing_user".
 *
 * @property int $id
 * @property int $title
 *
 * @property TestingUser[] $testingUsers
 */
class StatusTestingUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Status_testing_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'integer'],
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
     * Gets query for [[TestingUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestingUsers()
    {
        return $this->hasMany(TestingUser::class, ['status_testing_id' => 'id']);
    }

    public static function getStatusTestingId($title)
    {
        return static::findOne(['title' => $title])->id;
    }

    public static function getStatusTestingName($id)
    {
        return static::findOne(['id' => $id])->title;
    }

    public static function getStatusTestingList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }
}
