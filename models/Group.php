<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Group".
 *
 * @property int $id
 * @property string $title
 *
 * @property User[] $users
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Group';
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
            'title' => 'Номер',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id']);
    }

    public static function getGroupList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getGroupName($id)
    {
        return static::findOne(['id' => $id])->title;
    }
}
