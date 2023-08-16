<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Role".
 *
 * @property int $id
 * @property string $title
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Role';
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
            'title' => 'Название',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['role_id' => 'id']);
    }

    public static function getRoleId($title)
    {
        return static::findOne(['title' => $title])->id;
    }

    public static function getRoleName($id)
    {
        return static::findOne(['id' => $id])->title;
    }

    public static function getRoleList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }
}
